<?php

namespace App\Exports;

use App\ExamSet;
use App\Structure;
use App\User;
use App\UserExamScoreByCat;
use App\UserExamSet;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportReports implements FromCollection, WithMapping, WithHeadings
{

    protected $_c;
    public function __construct($a)
    {
        $this->c = $a;
        $s = UserExamSet::select(['id', 'user_id', 'score', 'status'])->where('exam_id', $this->c)->get();

        $i = 0;
        foreach ($s as $a) {

            $scoreby[$i] = UserExamScoreByCat::all()->where('userexamset_id', $a->id);

            $i = $i + 1;

        }
        $this->cb = $scoreby;

    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $s = UserExamSet::select(['id', 'user_id', 'score', 'status'])->where('exam_id', $this->c)->get();

        $m = 0;
        $i = 0;
        foreach ($s as $a) {

            $scoreby[$i] = UserExamScoreByCat::all()->where('userexamset_id', $a->id);

            $i = $i + 1;
        }
        $this->p = 0;
        $this->m = 0;
        $this->sb = $scoreby;

        return $s;
    }

    public function map($exam): array
    {
        $scoreby = $this->sb;
        $cateby = $this->cb;
        $exams = ExamSet::find($this->c);

        $str = Structure::find($exams->str_id);
        $str_set = DB::table('structure_sets')->where('set_id', $exams->str_id)->get();

        $x = count($scoreby[0]) + 4;
        $z = count($scoreby[0]) - 1;
        error_log($z);
        $m = 0;
        $q;
        $p = $this->p;
        for ($j = 0; $j < $z; $j++) {
            foreach ($scoreby[$j] as $ag) {

                foreach ($str_set as $srt) {
                    if ($srt->cate_id == $ag->cate_id) {
                        $q = (($srt->easy + $srt->medium + $srt->hard) * 100) / $str->count;
                    }
                }
                // error_log($ag->score);
                $num[$m] = ($ag->score * $q) / 100;
                $m = $m + 1;
            }

            $m = 0;
            $sum[$j] = $num;

        }

        for ($i = 0; $i < $x; $i++) {

            if (0 == $i) {
                $r[$i] = $exam->user_id;

            } elseif (1 == $i) {
                $r[$i] = $exam->User->name;

            } elseif ($i == $x - 2) {
                $r[$i] = $exam->score;

            } elseif ($i == $x - 1) {
                $r[$i] = $exam->status;

            } else {
                $r[$i] = "" . $sum[$p][$m];
                $m = $m + 1;
            }
        }
        $this->p = $p + 1;

        return $r;

    }

    public function headings(): array
    {
        $cateby = $this->cb;
        $z = count($cateby[0]);
        $x = count($cateby[0]) + 4;

        $m = 0;
        $k = 0;

        foreach ($cateby[0] as $cs) {
            $num[$m] = $cs->Category->topic;

            $m = $m + 1;

        }

        for ($i = 0; $i < $x; $i++) {

            if (0 == $i) {
                $e[$i] = 'รหัสประจำตัว';

            } elseif (1 == $i) {
                $e[$i] = 'ชื่อ';

            } elseif ($i == $x - 2) {
                $e[$i] = 'คะแนนรวม(100)';

            } elseif ($i == $x - 1) {
                $e[$i] = 'สถานะ';

            } else {
                $e[$i] = "หมวดหมู่" . $num[$k] . "(100)";
                $k = $k + 1;
            }
        }

        return $e;
    }

}
