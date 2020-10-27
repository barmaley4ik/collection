<?php
namespace App\Helpers;

use App\Helpers\Helpme;
use Cache;
use App\Admin\Language;
use App\Admin\SiteSetting;
use App\Admin\Vendor;
use App\Admin\Currency;
use App\Admin\Review;
use App\Front\ProductView;
use App\Front\Category;


class Seo 
{

	const SCHEMA_OR_OG_SITE = 'website';
	const SCHEMA_OR_OG_CATEGORY = 'category';
	const SCHEMA_OR_OG_PRODUCT = 'product';
	const SCHEMA_OR_OG_BLOG = 'blog';
	const SCHEMA_OR_OG_BLOGSINGLE = 'article';
	const SCHEMA_OR_OG_BREDCRUMS = 'contact';
	const SCHEMA_OR_OG_FAQ = 'faq';
	const SCHEMA_OR_OG_BREADCRUMS = 'BreadcrumbList';
	const SCHEMA_OR_OG_START = '<script type="application/ld+json">';
	const SCHEMA_OR_OG_END = '</script>';
	
		
	public static function getSchema($typePage, $id = null)
	{
		
		switch ($typePage) {
			
			case self::SCHEMA_OR_OG_SITE:
				$siteInfo = Helpme::getCacheDefaultItem(SiteSetting::class, SiteSetting::KEY_CACHE_DEFAULT);
				$images = json_decode($siteInfo->logo, true);
				$image = array_shift($images);		
		
				$schema = self::SCHEMA_OR_OG_START . PHP_EOL;	
				$schema .= '{' . PHP_EOL;	
				$schema .= '"@context": "http://schema.org/",' . PHP_EOL;	
				$schema .= '"@type": [' . PHP_EOL;	
				$schema .= '"Organization",' . PHP_EOL;	
				$schema .= '"LocalBusiness",' . PHP_EOL;	
				$schema .= '"ClothingStore"' . PHP_EOL;	
				$schema .= '],' . PHP_EOL;	
				$schema .= '"name":' .'"' . $siteInfo->name  . '",' . PHP_EOL;	
				$schema .= '"description":' . '"' .$siteInfo->meta_description . '",' . PHP_EOL;	
				$schema .= '"logo":' . '"' . $image['url'] . '",' . PHP_EOL;	
				$schema .= '"url":' . '"' . url()->current() . '",' . PHP_EOL;	
				$schema .= '"openingHours":' . '"' . $siteInfo->time_work . '",' . PHP_EOL ;	
				$schema .= '"image":' . '"' . $image['url'] . '",' . PHP_EOL ;	
				$schema .= '"address": {' . PHP_EOL;	
				$schema .= '"@type":  "PostalAddress",' . PHP_EOL;	
				$schema .= '"addressLocality":"' . $siteInfo->adress['city'] . ',' . $siteInfo->adress['country'] . '",' . PHP_EOL;	
				$schema .= '"streetAddress":"' . $siteInfo->adress['street'] . '"' . PHP_EOL;	
				$schema .= '},' . PHP_EOL;
				$schema .= '"telephone":"' . $siteInfo->phone[1] . '",' . PHP_EOL;	
				$schema .= '"priceRange": "$$-$$$",' . PHP_EOL;	
				$schema .= '"contactPoint": [' . PHP_EOL;
				$schema .= '{' . PHP_EOL;
				$schema .= '"@type": "ContactPoint",' . PHP_EOL;
				$schema .= '"telephone": "' . ($siteInfo->phone[2] ?? $siteInfo->phone[1]) . '",' . PHP_EOL;	
				$schema .= '"contactType": "customer service"' . PHP_EOL;	
				$schema .= '}' . PHP_EOL;	
				$schema .= '],' . PHP_EOL;					
				$schema .= '"mainEntityOfPage": {' . PHP_EOL;
				$schema .= '"@type": "WebPage",' . PHP_EOL;
				$schema .= '"@id": "'. url()->current() . '"' . PHP_EOL;
				$schema .= '},' . PHP_EOL;
				$schema .= '"sameAs" : [' . PHP_EOL;
				
				$i = 0;
				foreach ($siteInfo->socials as $social)
				{
					$social = str_replace(array('fb:', 'inst:'), array('', ''), $social);	
					if ($i>0) $schema .= ',' . PHP_EOL;
					$schema .= '"' . $social . '"';
					$i++;	
				}
				
				$schema .= PHP_EOL;
				$schema .= '],' . PHP_EOL;
				$schema .= '"potentialAction": {' . PHP_EOL;
				$schema .= '"@type": "SearchAction",' . PHP_EOL;
				$schema .= '"target": "' . route('front.search',['search-string' => 'search-string']) . '",' . PHP_EOL;
				$schema .= '"query-input": "required name=search-string"' . PHP_EOL;
				$schema .= '}' . PHP_EOL;
				$schema .= '}' . PHP_EOL;
				$schema .= self::SCHEMA_OR_OG_END;

				return $schema;
			
				break;
			
			case self::SCHEMA_OR_OG_BREADCRUMS:
				$breadcrums = Helpme::getBreadcrums(Helpme::BREDCRUMS_PRODUCT, $id);
				$i = 0;
				$schema = self::SCHEMA_OR_OG_START . PHP_EOL;	
				$schema .= '{' . PHP_EOL;	
				$schema .= '"@context": "http://schema.org/",' . PHP_EOL;	
				$schema .= '"@type": "' . self::SCHEMA_OR_OG_BREADCRUMS . '",' . PHP_EOL;	
				$schema .= '"itemListElement":' . PHP_EOL;	
				$schema .= '[' . PHP_EOL;	
				
					foreach($breadcrums  as  $item)
					{
						if ($i>0) $schema .= ',' . PHP_EOL;	;
						$schema .= '{' . PHP_EOL;	
						$schema .= '"@type": "ListItem",' . PHP_EOL;		
						$schema .= '"position":' . ++$i . ',' . PHP_EOL;	;	
						$schema .= '"item":' . PHP_EOL;							
						$schema .= '{' . PHP_EOL;							
						$schema .= '"@id": "' . $item['url'] . '",' . PHP_EOL;							
						$schema .= '"name": "' . $item['name']  . '"' . PHP_EOL;							
						$schema .= '}' . PHP_EOL;	
						$schema .= '}' . PHP_EOL;						
					}					
				
				$schema .= ']' . PHP_EOL;	
				$schema .= '}' . PHP_EOL;
				$schema .= self::SCHEMA_OR_OG_END;

				return $schema;			
				break;	
				
			case self::SCHEMA_OR_OG_CATEGORY:
			
				
				break;
				
			case self::SCHEMA_OR_OG_PRODUCT:
				
				$product = Helpme::getCacheSingleItemWithDelay(ProductView::class, ProductView::KEY_CACHE_SINGLE . '_' . $id, $id, $second = 600 );
				
				$currency = Helpme::getCacheDefaultItem(Currency::class, Currency::KEY_CACHE_DEFAULT);
				
				$productRelateds = Helpme::getCacheProductRelatedsWithDelay(ProductView::class, ProductView::KEY_CACHE_RELATEDS . '_' . $product->model, $product->model, $second = 600 );
				
				$reviews = Helpme::getCacheRelatedAllDelayItem(ProductView::KEY_CACHE_PROMO_REVIEWS . '_' . $product->id, $product, $relation = 'reviews', $second = 600 );	
				
				$stockstatus = 'https://schema.org/InStock';
				if ($product->quantity<=0) {
					$stockstatus = 'https://schema.org/OutOfStock';
				}
				
				$images = json_decode($product->image, true);
				$image = array_shift($images);	
		
				$schema = self::SCHEMA_OR_OG_START . PHP_EOL;	
				$schema .= '{' . PHP_EOL;	
				$schema .= '"@context": "http://schema.org/",' . PHP_EOL;	
				$schema .= '"@type": "Product",' . PHP_EOL;	
				$schema .= '"name": "' . $product->name . '",'. PHP_EOL;	
				$schema .= '"description": "' . $product->meta_description . '",'. PHP_EOL;	
				$schema .= '"image": "' . $image['url'] . '",'. PHP_EOL;	
				$schema .= '"url": "' . url()->current() . '",'. PHP_EOL;	
				$schema .= '"category": "'. $product->category_name . '",'. PHP_EOL;	
				$schema .= '"brand": "' . ($product->vendor_name ?? '') . '",'. PHP_EOL;	
				$schema .= '"manufacturer": "' . ($product->vendor_name ?? '') . '",'. PHP_EOL;	
				$schema .= '"model": "' . $product->model . '",'. PHP_EOL;	
				$schema .= '"sku": "' . $product->sku . '",'. PHP_EOL;	
				$schema .= '"gtin12": "' . $product->sku . '",'. PHP_EOL;					
				$schema .= '"offers": {' . PHP_EOL;					
				$schema .= '"@type": "Offer",' . PHP_EOL;	
				
				$schema .= '"availability": "' . $stockstatus . '",'. PHP_EOL;
				$schema .= '"price": "' . $product->price . '",'. PHP_EOL;
				$schema .= '"priceCurrency": "' . $currency->code . '",'. PHP_EOL;
				$schema .= '"priceValidUntil": "' . \Carbon\Carbon::parse('last day of December') . '",'. PHP_EOL;
				$schema .= '"url": "' . url()->current() . '"},'. PHP_EOL;
				$schema .= '"aggregateRating": {' . PHP_EOL;
				$schema .= '"@type": "AggregateRating",' . PHP_EOL;
				$schema .= '"ratingValue": "' . $product->rating . '",'. PHP_EOL;
				$schema .= '"reviewCount": "' . ($reviews ? count($reviews) :0) . '"},'. PHP_EOL;
				$schema .= '"review": [' . PHP_EOL;
				
				$i=0;
				if($reviews)
				{
				foreach($reviews as $review)
				{
					if($i>0) $schema .= ',' . PHP_EOL;
					$schema .= '{' . PHP_EOL;
					$schema .= '"@type": "Review",' . PHP_EOL;	
					$schema .= '"author": "' . $review->name . '",'. PHP_EOL;	
					$schema .= '"datePublished": "' . $review->created_at . '",'. PHP_EOL;	
					$schema .= '"description": "' . $review->text . '",'. PHP_EOL;	
					$schema .= '"reviewRating": {' . PHP_EOL;	
					$schema .= '"@type": "Rating",' . PHP_EOL;	
					$schema .= '"bestRating": "5",' . PHP_EOL;	
					$schema .= '"ratingValue": "' . $review->rating . '",' .PHP_EOL;	
					$schema .= '"worstRating": "1"' . PHP_EOL;
					$schema .= '}' . PHP_EOL;
					$schema .= '}';
					$i++;
				}
				}
				$schema .=  PHP_EOL . ']' . PHP_EOL;

				
				if ($productRelateds)
				{
					
					$schema .= ',"isRelatedTo": [' . PHP_EOL;
					$n = 0;
					foreach ($productRelateds as $product) 
					{
					if ($n>0)	$schema .= ',' . PHP_EOL;
					$schema .= '{' . PHP_EOL;
					$schema .= '"@type": "Product",' . PHP_EOL;
					
					$images = json_decode($product->image, true);
					$image = array_shift($images);		

					$schema .= '"image": "' . $image['url'] . '",'. PHP_EOL;
					
					$urlProductRelated = Helpme::getSiteUrl() . $product->category_slug . '/' . $product->slug;//array_pop($urlProductRelateds);

					$schema .= '"url": "' .$urlProductRelated.'",'. PHP_EOL;
					$schema .= '"name": "' .$product->name.'",'. PHP_EOL;
					$schema .= '"description": "' .$product->description.'",'. PHP_EOL;
					$schema .= '"offers": {' . PHP_EOL;
					$schema .= '"@type": "Offer",' . PHP_EOL;
					$schema .= '"price": "' . $product->price. '",'. PHP_EOL;
					$schema .= '"priceCurrency": "' . $currency->code. '"'. PHP_EOL;
					$schema .= '}' . PHP_EOL;
					$schema .= '}';
					$n++;
					}	
				
				}
				
				$schema .= PHP_EOL .']' . PHP_EOL;	
				$schema .= '}' . PHP_EOL;	
				$schema .= self::SCHEMA_OR_OG_END;	
		
				break;
		}			
			
		return $schema;
	}
	
	
	public static function getOpenGraph($typePage, $collection = null)
	{
		$languages = Helpme::getCacheAllItem(Language::class, Language::KEY_CACHE_ALL);

		$siteInfo = Helpme::getCacheDefaultItem(SiteSetting::class, SiteSetting::KEY_CACHE_DEFAULT);
		
		if ($typePage === self::SCHEMA_OR_OG_SITE) 
		{
			$collection = $siteInfo;
		}
		
		$openGraph  = '    <meta name="referrer" content="origin">' . PHP_EOL;
		$openGraph .= '	<title>'. $collection->meta_title . '</title>' . PHP_EOL;
		$openGraph .= '	<meta name="description" content="'. $collection->meta_description . '">' . PHP_EOL;
		$openGraph .= '	<meta name="keywords" content="'. $collection->meta_keywords . '">' . PHP_EOL;
		$openGraph .= '	<meta name="og:type" content="'. $typePage . '">' . PHP_EOL;
		$openGraph .= '	<meta name="og:title" content="'. $collection->meta_title . '">' . PHP_EOL;
		$openGraph .= '	<meta name="og:description" content="'. $collection->meta_description . '">' . PHP_EOL;
		$openGraph .= '	<meta name="og:url" content="'.  url()->current() . '">' . PHP_EOL;
		
		$images = json_decode($collection->logo ?? $collection->image, true);
		
		$i = 0;
		
		if($images) {
			foreach ($images as $image) 
			{
				if ($i == 0) {
					$image = $image;
				}
			}
			
			$openGraph .= '	<meta name="og:image" content="'. $image['url'] . '">' . PHP_EOL;
			$openGraph .= '	<meta name="og:site_name" content="'. $siteInfo->name .'">' . PHP_EOL;
		}
		
		$languages = $languages->sortBy('encoding');
		
		foreach($languages as $language)
		{
			if ($language->is_default == 1) 
			{
				$openGraph .= '	<meta name="og:locale" content="' . $language->code .'">' . PHP_EOL;	
			} else
			{
				$openGraph .= '	<meta name="og:locale:alternate" content="' . $language->code .'">' . PHP_EOL;	
			}
		}		
		
		foreach($languages as $language)
		{
			if ($language->is_default == 1) 
			{
				$openGraph .= '	<link rel="alternate" href="' . url()->current() . '" hreflang="'. $language->code .'"/>' . PHP_EOL;	
			} else
			{
				$openGraph .= '	<link rel="alternate" href="' . (str_replace (url()->to('/'), url()->to('/') . '/'. $language->encoding,  url()->current())) . '" hreflang="'. $language->code .'"/>' . PHP_EOL;	
			}
		}
		

		
		return $openGraph;
	}		
}