<?php
namespace App\Modules\General\Providers;

use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

//use App\Modules\General\Http\Domain\Models\Menu;
use App\Modules\General\Http\Domain\Typi\Menus\EloquentMenu;
use App\Modules\General\Http\Domain\Typi\Menus\CacheDecorator;
use App\Modules\General\Http\Services\Cache\LaravelCache;

/*
use Fully\Models\Article;
use Fully\Models\Category;
use Fully\Models\Page;
use Fully\Models\Faq;
use Fully\Models\News;
Use Fully\Models\PhotoGallery;
use Fully\Models\Project;
use Fully\Models\Tag;
use Fully\Models\Video;
use Fully\Models\Slider;
use Fully\Models\Setting;
*/

// use App\Modules\General\Http\Domain\Menu\MenuRepository;
// use App\Modules\General\Http\Domain\Menu\CacheDecorator as MenuCacheDecorator;

/*
use Fully\Repositories\Article\ArticleRepository;
use Fully\Repositories\Article\CacheDecorator as ArticleCacheDecorator;
//
use Fully\Repositories\Category\CategoryRepository;
use Fully\Repositories\Category\CacheDecorator as CategoryCacheDecorator;
//
use Fully\Repositories\Page\PageRepository;
use Fully\Repositories\Page\CacheDecorator as PageCacheDecorator;
//
use Fully\Repositories\Faq\FaqRepository;
use Fully\Repositories\Faq\CacheDecorator as FaqCacheDecorator;
//
use Fully\Repositories\News\NewsRepository;
use Fully\Repositories\News\CacheDecorator as NewsCacheDecorator;
//
use Fully\Repositories\PhotoGallery\PhotoGalleryRepository;
use Fully\Repositories\PhotoGallery\CacheDecorator as PhotoGalleryCacheDecorator;
//
use Fully\Repositories\Project\ProjectRepository;
use Fully\Repositories\Project\CacheDecorator as ProjectCacheDecorator;
//
use Fully\Repositories\Tag\TagRepository;
use Fully\Repositories\Tag\CacheDecorator as TagCacheDecorator;
//
use Fully\Repositories\Video\VideoRepository;
use Fully\Repositories\Video\CacheDecorator as VideoCacheDecorator;
//
use Fully\Repositories\Slider\SliderRepository;
use Fully\Repositories\Slider\CacheDecorator as SliderCacheDecorator;
//
use Fully\Repositories\Setting\SettingRepository;
use Fully\Repositories\Setting\CacheDecorator as SettingCacheDecorator;
*/

//use App\Modules\General\Http\Services\Cache\FullyCache;

/**
 * Class RepositoryServiceProvider
 * @package Fully\Repositories
 * @author Sefa Karagöz
 */
class RepositoryServiceProvider extends ServiceProvider {

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register() {

		$app = $this->app;

		//dd($app['config']->get('fully.cache'));
/*
		// menu
		$app->bind('App\Modules\General\Http\Domain\Menu\MenuInterface', function ($app) {

			$menu = new MenuRepository(
				new Menu
			);

			if ($app['config']->get('fully.cache') === true && $app['config']->get('is_admin', false) == false) {

				$menu = new MenuCacheDecorator(
					$menu,
					new FullyCache($app['cache'], 'menus')
				);
			}

			return $menu;
		});
*/

//		$app->view->composer('core::admin._sidebar', 'TypiCMS\Modules\Menus\Composers\SidebarViewComposer');

		$app->bind('App\Modules\General\Http\Domain\Typi\Menus\LinkerInterface', function (Application $app) {

			$repository = new EloquentMenu(new Menu);
			if (! config('typicms.cache')) {
				return $repository;
			}
//dd($repository);

//			$laravelCache = new LaravelCache($app['cache'], ['menus', 'menulinks', 'pages'], 10);
			$laravelCache = new LaravelCache($app['cache'], ['menus', 'menulinks'], 10);

			return new CacheDecorator($repository, $laravelCache);

		});



/*
		// article
		$app->bind('Fully\Repositories\Article\ArticleInterface', function ($app) {

			$article = new ArticleRepository(
				new Article
			);

			if ($app['config']->get('fully.cache') === true && $app['config']->get('is_admin', false) == false) {

				$article = new ArticleCacheDecorator(
					$article,
					new FullyCache($app['cache'], 'articles')
				);
			}

			return $article;
		});

		// category
		$app->bind('Fully\Repositories\Category\CategoryInterface', function ($app) {

			$category = new CategoryRepository(
				new Category
			);


			if ($app['config']->get('fully.cache') === true && $app['config']->get('is_admin', false) == false) {

				$category = new CategoryCacheDecorator(
					$category,
					new FullyCache($app['cache'], 'categories')
				);
			}

			return $category;
		});


		// page
		$app->bind('Fully\Repositories\Page\PageInterface', function ($app) {

			$page = new PageRepository(
				new Page
			);

			if ($app['config']->get('fully.cache') === true && $app['config']->get('is_admin', false) == false) {

				$page = new PageCacheDecorator(
					$page,
					new FullyCache($app['cache'], 'pages')
				);
			}

			return $page;
		});


		// faq
		$app->bind('Fully\Repositories\Faq\FaqInterface', function ($app) {

			$faq = new FaqRepository(
				new Faq
			);

			if ($app['config']->get('fully.cache') === true && $app['config']->get('is_admin', false) == false) {

				$faq = new FaqCacheDecorator(
					$faq,
					new FullyCache($app['cache'], 'faqs')
				);
			}

			return $faq;
		});


		// news
		$app->bind('Fully\Repositories\News\NewsInterface', function ($app) {

			$news = new NewsRepository(
				new News
			);

			if ($app['config']->get('fully.cache') === true && $app['config']->get('is_admin', false) == false) {

				$news = new NewsCacheDecorator(
					$news,
					new FullyCache($app['cache'], 'pages')
				);
			}

			return $news;
		});

		// photo gallery
		$app->bind('Fully\Repositories\PhotoGallery\PhotoGalleryInterface', function ($app) {

			$photoGallery = new PhotoGalleryRepository(
				new PhotoGallery
			);

			if ($app['config']->get('fully.cache') === true && $app['config']->get('is_admin', false) == false) {

				$photoGallery = new PhotoGalleryCacheDecorator(
					$photoGallery,
					new FullyCache($app['cache'], 'photo_galleries')
				);
			}

			return $photoGallery;
		});


		// project
		$app->bind('Fully\Repositories\Project\ProjectInterface', function ($app) {

			$project = new ProjectRepository(
				new Project
			);

			if ($app['config']->get('fully.cache') === true && $app['config']->get('is_admin', false) == false) {

				$project = new ProjectCacheDecorator(
					$project,
					new FullyCache($app['cache'], 'projects')
				);
			}

			return $project;
		});

		// tag
		$app->bind('Fully\Repositories\Tag\TagInterface', function ($app) {

			$tag = new TagRepository(
				new Tag
			);

			if ($app['config']->get('fully.cache') === true && $app['config']->get('is_admin', false) == false) {

				$tag = new TagCacheDecorator(
					$tag,
					new FullyCache($app['cache'], 'tags')
				);
			}

			return $tag;
		});

		// video
		$app->bind('Fully\Repositories\Video\VideoInterface', function ($app) {

			$video = new VideoRepository(
				new Video
			);

			if ($app['config']->get('fully.cache') === true && $app['config']->get('is_admin', false) == false) {

				$video = new VideoCacheDecorator(
					$video,
					new FullyCache($app['cache'], 'pages')
				);
			}

			return $video;
		});

		// slider
		$app->bind('Fully\Repositories\Slider\SliderInterface', function ($app) {

			$slider = new SliderRepository(
				new Slider
			);

			if ($app['config']->get('fully.cache') === true && $app['config']->get('is_admin', false) == false) {

				$slider = new SliderCacheDecorator(
					$slider,
					new FullyCache($app['cache'], 'sliders')
				);
			}

			return $slider;
		});

		// setting
		$app->bind('Fully\Repositories\Setting\SettingInterface', function ($app) {

			$setting = new SettingRepository(
				new Setting
			);

			if ($app['config']->get('fully.cache') === true && $app['config']->get('is_admin', false) == false) {

				$setting = new SettingCacheDecorator(
					$setting,
					new FullyCache($app['cache'], 'settings')
				);
			}

			return $setting;
		});
*/
	}


}
