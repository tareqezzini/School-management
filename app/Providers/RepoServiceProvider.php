<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepoServiceProvider extends ServiceProvider
{
   
    public function register()
    {
        $this->app->bind(
            'App\Repository\TeachersRepositoryInterface',
            'App\Repository\TeachersRepository');
        $this->app->bind(
            'App\Repository\StudentsRepositoryInterface',
            'App\Repository\StudentsRepository');
        $this->app->bind(
            'App\Repository\PromotionsRepositoryInterface',
            'App\Repository\PromotionsRepository');
        $this->app->bind(
            'App\Repository\GraduatedRepositoryInterface',
            'App\Repository\GraduatedRepository');
        $this->app->bind(
            'App\Repository\FeesRepositoryInterface',
            'App\Repository\FeesRepository');
        $this->app->bind(
            'App\Repository\FeesInvoicesRepositoryInterface',
            'App\Repository\FeesInvoicesRepository');
        $this->app->bind(
            'App\Repository\ReceiptStudentsRepositoryInterface',
            'App\Repository\ReceiptStudentsRepository');
        $this->app->bind(
            'App\Repository\ProcessingFeeRepositoryInterface',
            'App\Repository\ProcessingFeeRepository');
        $this->app->bind(
            'App\Repository\PaymentRepositoryInterface',
            'App\Repository\PaymentRepository');
        $this->app->bind(
            'App\Repository\AttendanceRepositoryInterface',
            'App\Repository\AttendanceRepository');
        $this->app->bind(
            'App\Repository\SubjectsRepositoryInterface',
            'App\Repository\SubjectsRepository');
        $this->app->bind(
            'App\Repository\QuizzesRepositoryInterface',
            'App\Repository\QuizzesRepository');
        $this->app->bind(
            'App\Repository\QuestionRepositoryInterface',
            'App\Repository\QuestionRepository');
        $this->app->bind(
            'App\Repository\LibraryRepositoryInterface',
            'App\Repository\LibraryRepository');
    }

   
    public function boot()
    {
        //
    }
}