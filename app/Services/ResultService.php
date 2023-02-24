<?php

namespace App\Services;

use App\Models\Result;
use Illuminate\Database\Eloquent\Collection;

class ResultService
{
    /**
     * @param int $userId
     * @return Collection
     */
    public function getHistory(int $userId):Collection
    {
        return Result::where('user_id', $userId)
            ->orderBy('id', 'desc')
            ->take(3)
            ->get();
    }

    /**
     * @param int $userId
     * @return Result
     */
    public function doLottery(int $userId):Result
    {
        $winAmount = 0;
        $randomNumber = rand(1, 1000);
        $lotteryResult = $this->checkIfWinner($randomNumber);

        if ($lotteryResult === 'win') {
            $winAmount = $this->calculateWinAmount($randomNumber);
        }

        $result = new Result();
        $result['user_id'] = $userId;
        $result['number'] = $randomNumber;
        $result['amount'] = $winAmount;
        $result['lottery_result'] = $lotteryResult;

        $result->save();

        return $result;
    }

    /**
     * @param int $value
     * @return string
     */
    public function checkIfWinner(int $value):string
    {
        if ($value % 2 === 0) {
            $result = 'win';
        } else {
            $result = 'lose';
        }

        return $result;
    }

    /**
     * @param int $value
     * @return int
     */
    public function calculateWinAmount(int $value):float
    {
        if ($value > 900) {
            return ($value * 0.70);
        }
        if ($value > 600) {
            return ($value * 0.50);
        }
        if ($value > 300) {
            return ($value * 0.30);
        }

        return ($value * 0.10);
    }
}
