<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Model;

class AssessmentTest extends Model
{
    protected $table = "assessment_tests";
    protected $guarded = [];
    protected $appends = ['content','single_option'];

    public function getContentAttribute()
    {
        $options = isset($this->options) ? explode(',', $this->options) : [];
        $content = '';

        $content .= 'A. ' . $options[0]."<br>" ?? '&nbsp;"<br>"';
        $content .= 'B. ' . $options[1]."<br>" ?? '&nbsp;"<br>"';
        $content .= 'C. ' . $options[2]."<br>" ?? '&nbsp;"<br>"';
        $content .= 'D. ' . $options[3]."<br>" ?? '&nbsp;"<br>"';

        return $content;
    }

    public function getSingleOptionAttribute()
    {
        return isset($this->options) ? explode(',', $this->options) : [];
    }
}
