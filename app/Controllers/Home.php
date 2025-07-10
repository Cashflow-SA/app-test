<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }

    public function showRobotsFile()
    {
        $baseUrl = base_url();

        $robotsTxt = "User-agent: *\n";
        $robotsTxt .= "Crawl-delay: 10\n";

        $supportedLocales = ['fr', 'de', 'en'];

        // Disallow sensitive or non-SEO pages
        foreach($supportedLocales as $locale){
            $robotsTxt .= "Disallow: {$locale}/therealcorrectfile/\n";
            $robotsTxt .= "Disallow: {$locale}/login/\n";
            $robotsTxt .= "Disallow: {$locale}/logout\n";
            $robotsTxt .= "Disallow: {$locale}/signup/\n";
            $robotsTxt .= "Disallow: {$locale}/password/\n";
            $robotsTxt .= "Disallow: {$locale}/profile/\n";
            $robotsTxt .= "Disallow: {$locale}/cart/\n";
            $robotsTxt .= "Disallow: {$locale}/checkout/\n";
            $robotsTxt .= "Disallow: {$locale}/authenticator/\n";
            $robotsTxt .= "Disallow: {$locale}/deleteaccount\n";
        }

        // Pages without any locale
        $robotsTxt .= "Disallow: /ajaxCheckStock\n";
        $robotsTxt .= "Disallow: /ajaxAddToCart\n";
        $robotsTxt .= "Disallow: /webhook/\n";

        // Allow public assets (images, pdfs)
        $robotsTxt .= "Allow: /image/\n";
        $robotsTxt .= "Allow: /pdf/\n\n";

        // Sitemap
        $robotsTxt .= "Sitemap: {$baseUrl}sitemap.xml\n";

        return $this->response->setContentType('text/plain')->setBody($robotsTxt);
    }
}
