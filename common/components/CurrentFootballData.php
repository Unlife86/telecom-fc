<?php
namespace common\components;

use Yii;
use yii\base\Component;
use common\models\Seasons;
use common\models\Matches;
use backend\models\MatchesSearch;
use common\models\Tournament;
use common\models\League;

class CurrentFootballData extends Component
{

    private function caseMonth($month) {
        switch ($month) {
            case 'января': $rus = 'январь'; break;
            case 'февраля': $rus = 'февраль'; break;
            case 'марта': $rus = 'март'; break;
            case 'апреля': $rus = 'апрель'; break;
            case 'мая': $rus = 'май'; break;
            case 'июня': $rus = 'июнь'; break;
            case 'июля': $rus = 'июль'; break;
            case 'августа': $rus = 'август'; break;
            case 'сентября': $rus = 'сентябрь'; break;
            case 'октября': $rus = 'октябрь'; break;
            case 'ноября': $rus = 'ноябрь'; break;
            case 'декабря': $rus = 'декабрь'; break;
        }
        return $rus;
    }
    /*Function get all data of league (id, name, type)*/
    public function getListLeague()
    {
        $league = League::find()->select(['id', 'name', 'current'])->all();
        return $league;
    }
    public function getCurrentLeague($id = null)
    {
        if  ($id == null) {
            $league = League::find()->select(['id', 'name', 'type'])->where(['current' => 1])->one();
        } else {
            $league = League::findOne($id);
        }
        return $league;
    }
        /*Function get all played matches of league in current tour */
    public function getCountMatches() {
        $count = Matches::find()->andWhere(['n_tour' => $this->getCurrentTour(), 'id_league' => $this->getCurrentLeague()->id])->andWhere(['not',['score_h'=> null]])->count();
        return $count;
    }
    /*Function get last season in league*/
    public function getCurrentSeason($league = null) {
        if ($league == null) {$league = $this->getCurrentLeague()->id;}
        if ($this->getCurrentLeague($league)->type == 'play-off' ) {
            $season = Matches::find()->select('id_season')->where(['id_league' => $league])->max('id_season');
        } else {
            $season = Tournament::find()->select('id_season')->where(['id_league' => $league])->max('id_season');
        }

        return $season;
    }
    /*Function get year season on its id*/
    public function getYearSeason($id) {
        $year = Seasons::findOne($id);
        return $year->year;
    }
    /*Function get last tour of league in season*/
    public function getCurrentTour($season = null, $league = null)
    {
        if ($season == null) {$season = $this->getCurrentSeason();}
        if ($league == null) {$league = $this->getCurrentLeague()->id;}
        $type = $this->getCurrentLeague($league)->type;
        if ($type == 'play-off' ) {
            $tour = Matches::find()->select('n_tour')->andWhere(['id_season' => $season, 'id_league' => $league, 'score_h' => null])->andWhere(['not',['date_match'=> null]])->min('n_tour');
            if ($tour == null) { $tour = Matches::find()->select('n_tour')->andWhere(['id_season' => $season, 'id_league' => $league])->max('n_tour'); }
        } else {
            $tour = Tournament::find()->select('n_tour')->andWhere(['id_season' => $season, 'id_league' => $league])->max('n_tour');
        }
        return $tour;
    }
    /*Next match widget*/
    public function getNextMatchDate()
    {
        $match = Matches::find()->select(['id', 'date_match'])->where(['score_h' => null, 'id_season' => $this->getCurrentSeason(), 'id_league' => $this->getCurrentLeague()->id])->andWhere(['or','id_guest=8', 'id_home=8'])->orderBy(['date_match' => SORT_ASC])->one();
        if ($match == null) {
            $match = Matches::find()->select(['id'])->where(['id_season' => $this->getCurrentSeason(), 'id_league' => $this->getCurrentLeague()->id])->andWhere(['or','id_guest=8', 'id_home=8'])->max('id');
            return ['date' => null, 'id' => $match];
        } else {
            $date = new \DateTime($match->date_match);
            $date = date_modify($date, '-1 month');
            $date = Yii::$app->formatter->asDate($date, 'php:Y,n,d,H,i,s');
            return ['date' => $date, 'id' => $match->id];
        }
    }

    public function getNextMatchProvider()
    {
        $searchMatches = new MatchesSearch(['id' => $this->getNextMatchDate()['id']]);
        $nextMatch = $searchMatches->search(Yii::$app->request->queryParams);
        /*$nextMatch->query->where(['and',['score_h' => null, 'n_tour' => $this->getCurrentTour()],['or','id_guest=8', 'id_home=8']])->orderBy(['date_match' => SORT_ASC])->one();
        $nextMatch->pagination->pageSize = 1;
        $nextMatch->totalCount = 1;*/
        return $nextMatch;
    }
    /* --------------------------------- */
    /*Other function*/
    public function getMonth($date)
    {
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            setlocale(LC_ALL, "russian");
            $month = iconv("windows-1251","utf-8", strftime('%B', strtotime($date)));
            return mb_strtolower($month);
        } else {
            setlocale(LC_ALL, "ru_RU.UTF-8");
            $month = strftime('%B', strtotime($date));
            return $this->caseMonth(trim(mb_strtolower($month)));
        }

    }
    public function getFilesFolder($folder, $elem) {
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            return Yii::getAlias('@web').$folder.substr(strstr($elem,'\\'),1);
        } else {
            return stristr($elem,$folder);
        }
    }
    public function getDsnAttribute($name, $dsn)
    {
        if (preg_match('/' . $name . '=([^;]*)/', $dsn, $match)) {
            return $match[1];
        } else {
            return null;
        }
    }
}
?>

