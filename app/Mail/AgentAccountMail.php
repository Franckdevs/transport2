<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AgentAccountMail extends Mailable
{
    use Queueable, SerializesModels;

    public $agent;
    public $password;
    public $subject;
    public $compagnie;
    public $template;

    /**
     * Create a new message instance.
     *
     * @param mixed $agent
     * @param string $password
     * @param string $subject
     * @param string $template
     * @return void
     */
    public function __construct($agent, $password, $compagnie , $subject , $template)
    {
        $this->agent = $agent;
        $this->password = $password;
        $this->compagnie = $compagnie;
        $this->subject = $subject;
        $this->template = $template;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)
                    ->view($this->template);
    }
}
