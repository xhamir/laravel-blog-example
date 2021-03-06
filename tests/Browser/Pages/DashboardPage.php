<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Page as BasePage;

class DashboardPage extends BasePage
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/home';
    }

    /**
     * Assert that the browser is on the page.
     *
     * @param  Browser  $browser
     * @return void
     */
    public function assert(Browser $browser)
    {
        $browser->assertPathIs($this->url());
    }

    /**
     * Assert that the page shows the posts.
     *
     * @param  Browser  $browser
     * @param  collection|array|mixed  $browser
     * @return void
     */
    public function assertSeePosts(Browser $browser, $posts)
    {
        $segments = ceil($posts->count() / 10);

        if ($segments > 1)
        {
            for ($segment = 1; $segment <= $segments; $segment++)
            {
                $browser->visit(route('home', ['page' => $segment]))
                        ->assertSeePostsSegment($posts->forPage($segment, $segment * 10));
            }
        }
    }

    /**
     * Assert that the page shows posts segment.
     *
     * @param  Browser  $browser
     * @param  collection|array|mixed  $browser
     * @return void
     */
    public function assertSeePostsSegment(Browser $browser, $posts)
    {
        $posts->each(function ($post) use ($browser, $posts) {
            $browser->assertSee($post->id)
                    ->assertSee($post->title);
        });
    }



    /**
     * Get the element shortcuts for the page.
     *
     * @return array
     */
    public function elements()
    {
        return [
            '@posts' => '#posts-list',
        ];
    }
}
