<?php

namespace App\My\Objects;

use Illuminate\Support\Facades\Mail as MailFacade;


class Mail
{
    protected $defaultTo = 'twentiethsite@linux.pl';
    protected $defaultSubject = 'AG-PHOTOGRAPHY';
    protected $baseViewsPath = 'photos.email_templates';
    
    protected $to;
    protected $cc = [];
    protected $bcc = [];
    protected $subject;
    protected $content = '';
    protected $view;
    protected $filePath;

    public function __construct()
    {
        $this->to = [$this->defaultTo];
        $this->subject = $this->defaultSubject;
    }

    public function setTo($to)
    {
        if (is_string($to)) {
            $this->to = [$to];
        } elseif (is_array($to)) {
            $this->to = $to;
        }

        return $this;
    }

    public function addTo($to)
    {
        if (is_string($to)) {
            $this->to[] = $to;
        } elseif (is_array($to)) {
            $this->to = array_merge($this->to, $to);
        }

        return $this;
    }

    public function getTo()
    {
        return $this->to;
    }

    public function setCc($cc)
    {
        if (is_string($cc)) {
            $this->cc = [$cc];
        } elseif (is_array($cc)) {
            $this->cc = $cc;
        }

        return $this;
    }

    public function addCc($cc)
    {
        if (is_string($cc)) {
            $this->cc[] = $cc;
        } elseif (is_array($cc)) {
            $this->cc = array_merge($this->cc, $cc);
        }

        return $this;
    }

    public function getCc()
    {
        return $this->cc;
    }

    public function setBcc($bcc)
    {
        if (is_string($bcc)) {
            $this->bcc = [$bcc];
        } elseif (is_array($bcc)) {
            $this->bcc = $bcc;
        }

        return $this;
    }

    public function addBcc($bcc)
    {
        if (is_string($bcc)) {
            $this->bcc[] = $bcc;
        } elseif (is_array($bcc)) {
            $this->bcc = array_merge($this->bcc, $bcc);
        }

        return $this;
    }

    public function getBcc()
    {
        return $this->bcc;
    }

    public function setSubject(string $subject)
    {
        $this->subject = $subject;
        return $this;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function setContent(string $content)
    {
        $this->content = $content;
        return $this;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setView(string $view)
    {
        $this->view = $this->baseViewsPath . '.' . $view;
        return $this;
    }

    public function getView()
    {
        return $this->view;
    }

    public function getFilePath()
    {
        return $this->filePath;
    }

    public function setFilePath(string $filePath)
    {
        $this->filePath = $filePath;

        return $this;
    }

    public function send($vdata = null, string $vdataName = 'vdata')
    {
        if (!is_array($vdata) && !is_object($vdata)) {
            $vdata = null;
        }
        MailFacade::send($this->view, ['title' => $this->subject, 'content' => $this->content, $vdataName => $vdata], function($message) {
            if (!empty($this->to)) {
                foreach ($this->to as $to) {
                    $message->to($to);
                }
            }
            if (!empty($this->cc)) {
                foreach ($this->cc as $cc) {
                    $message->cc($cc);
                }
            }
            if (!empty($this->bcc)) {
                $message->bcc($this->bcc);
            }
            $message->subject($this->subject);
            if (isset($this->filePath)) {
                $message->attach($this->filePath);
            }
        });
    }
}
