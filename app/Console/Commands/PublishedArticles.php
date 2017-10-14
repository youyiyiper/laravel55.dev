<?php

namespace App\Console\Commands;

use App\Repositories\ArticlesRepository;
use Illuminate\Console\Command;

class PublishedArticles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:publicedArticles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '自动发布文章';

    protected $ArticlesRpt;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ArticlesRepository $ArticlesRpt)
    {
        parent::__construct();

        $this->ArticlesRpt = $ArticlesRpt;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        return $this->ArticlesRpt->autoPublicedArticles();
    }
}
