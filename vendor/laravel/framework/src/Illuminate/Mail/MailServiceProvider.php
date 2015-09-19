<?php namespace Illuminate\Mail;

use Swift_Mailer;
use Illuminate\Support\ServiceProvider;
use Swift_SmtpTransport as SmtpTransport;
use Swift_MailTransport as MailTransport;
use Illuminate\Mail\Transport\LogTransport;
use Illuminate\Mail\Transport\MailgunTransport;
use Illuminate\Mail\Transport\MandrillTransport;
use Swift_SendmailTransport as SendmailTransport;

class MailServiceProvider extends ServiceProvider {

  /**
   * Indicates if loading of the provider is deferred.
   *
   * @var bool
   */
  protected $defer = true;

  /**
   * Register the service provider.
   *
   * @return void
   */
  public function register()
  {
    $me = $this;

    $this->app->bindShared('mailer', function($app) use ($me)
    {
      $me->registerSwiftMailer();

      // Once we have create the mailer instance, we will set a container instance
      // on the mailer. This allows us to resolve mailer classes via containers
      // for maximum testability on said classes instead of passing Closures.
      $mailer = new Mailer(
        $app['view'], $app['swift.mailer'], $app['events']
      );

      $this->setMailerDependencies($mailer, $app);

      // If a "from" address is set, we will set it on the mailer so that all mail
      // messages sent by the applications will utilize the same "from" address
      // on each one, which makes the developer's life a lot more convenient.
      $from = $app['config']['mail.from'];

      if (is_array($from) && isset($from['address']))
      {
        $mailer->alwaysFrom($from['address'], $from['name']);
      }

      // Here we will determine if the mailer should be in "pretend" mode for this
      // environment, which will simply write out e-mail to the logs instead of
      // sending it over the web, which is useful for local dev environments.
      $pretend = $app['config']->get('mail.pretend', false);

      $mailer->pretend($pretend);

      return $mailer;
    });
  }

  /**
   * Set a few dependencies on the mailer instance.
   *
   * @param  \Illuminate\Mail\Mailer  $mailer
   * @param  \Illuminate\Foundation\Application  $app
   * @return void
   */
  protected function setMailerDependencies($mailer, $app)
  {
    $mailer->setContainer($app);

    if ($app->bound('log'))
    {
      $mailer->setLogger($app['log']);
    }

    if ($app->bound('queue'))
    {
      $mailer->setQueue($app['queue']);
    }
  }

  /**
   * Register the Swift Mailer instance.
   *
   * @return void
   */
  public function registerSwiftMailer()
  {
    $config = $this->app['config']['mail'];

    $this->registerSwiftTransport($config);

    // Once we have the transporter registered, we will register the actual Swift
    // mailer instance, passing in the transport instances, which allows us to
    // override this transporter instances during app start-up if necessary.
    $this->app['swift.mailer'] = $this->app->share(function($app)
    {
      return new Swift_Mailer($app['swift.transport']);
    });
  }

  /**
   * Register the Swift Transport instance.
   *
   * @param  array  $config
   * @return void
   *
   * @throws \InvalidArgumentException
   */
  protected function registerSwiftTransport($config)
  {
    switch ($config['driver'])
    {
      case 'smtp':
        return $this->registerSmtpTransport($config);

      case 'sendmail':
        return $this->registerSendmailTransport($config);

      case 'mail':
        return $this->registerMailTransport($config);

      case 'mailgun':
        return $this->registerMailgunTransport($config);

      case 'mandrill':
        return $this->registerMandrillTransport($config);

      case 'log':
        return $this->registerLogTransport($config);

      default:
        throw new \InvalidArgumentException('Invalid mail driver.');
    }
  }

  /**
   * Register the SMTP Swift Transport instance.
   *
   * @param  array  $config
   * @return void
   */
  protected function registerSmtpTransport($config)
  {
    $this->app['swift.transport'] = $this->app->share(function($app) use ($config)
    {
      extract($config);

      // The Swift SMTP transport instance will allow us to use any SMTP backend
      // for delivering mail such as Sendgrid, Amazon SES, or a custom server
      // a developer has available. We will just pass this configured host.
      $transport = SmtpTransport::newInstance($host, $port);

      if (isset($encryption))
      {
        $transport->setEncryption($encryption);
      }

      // Once we have the transport we will check for the presence of a username
      // and password. If we have it we will set the credentials on the Swift
      // transporter instance so that we'll properly authenticate delivery.
      if (isset($username))
      {
        $transport->setUsername($username);

        $transport->setPassword($password);
      }

      return $transport;
    });
  }

  /**
   * Register the Sendmail Swift Transport instance.
   *
   * @param  array  $config
   * @return void
   */
  protected function registerSendmailTransport($config)
  {
    $this->app['swift.transport'] = $this->app->share(function($app) use ($config)
    {
      return SendmailTransport::newInstance($config['sendmail']);
    });
  }

  /**
   * Register the Mail Swift Transport instance.
   *
   * @param  array  $config
   * @return void
   */
  protected function registerMailTransport($config)
  {
    $this->app['swift.transport'] = $this->app->share(function()
    {
      return MailTransport::newInstance();
    });
  }

  /**
   * Register the Mailgun Swift Transport instance.
   *
   * @param  array  $config
   * @return void
   */
  protected function registerMailgunTransport($config)
  {
    $mailgun = $this->app['config']->get('services.mailgun', array());

    $this->app->bindShared('swift.transport', function() use ($mailgun)
    {
      return new MailgunTransport($mailgun['secret'], $mailgun['domain']);
    });
  }

  /**
   * Register the Mandrill Swift Transport instance.
   *
   * @param  array  $config
   * @return void
   */
  protected function registerMandrillTransport($config)
  {
    $mandrill = $this->app['config']->get('services.mandrill', array());

    $this->app->bindShared('swift.transport', function() use ($mandrill)
    {
      return new MandrillTransport($mandrill['secret']);
    });
  }

  /**
   * Register the "Log" Swift Transport instance.
   *
   * @param  array  $config
   * @return void
   */
  protected function registerLogTransport($config)
  {
    $this->app->bindShared('swift.transport', function($app)
    {
      return new LogTransport($app->make('Psr\Log\LoggerInterface'));
    });
  }

  /**
   * Get the services provided by the provider.
   *
   * @return array
   */
  public function provides()
  {
    return array('mailer', 'swift.mailer', 'swift.transport');
  }

}
