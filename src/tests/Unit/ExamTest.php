<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Exam;

class ExamTest extends TestCase
{
    public function testSample()
    {
        $exam = new Exam();
        $this->assertEquals($exam->Sample(), 5);
    }

    public function testCase1()
    {
        $exam = new Exam();
        $this->assertEquals($exam->Case1(), 100);
    }

    public function testCase2()
    {
        $exam = new Exam();
        $this->assertEquals($exam->Case2(), 21);
    }

    public function testCase3()
    {
        $exam = new Exam();
        $this->assertEquals($exam->Case3(), 989);
    }

    public function testCase4()
    {
        $exam = new Exam();
        $this->assertEquals($exam->Case4(), '開発部');
    }

    public function testCase5()
    {
        $exam = new Exam();
        $this->assertEquals($exam->Case5(), '喜嶋 知実');
    }
}
