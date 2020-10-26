<?php

namespace App\Http\Middleware;

use App\Locale;
use Closure;
use Carbon\Carbon;

/**
 * Class LocaleMiddleware.
 */
class LocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /*
         * Locale is enabled and allowed to be changed
         */
        if (config('locale.status')) {
            $locales = Locale::get();
            $locales_list = $locales->pluck('short_name')->toArray();
            if (session()->has('locale') && in_array(session()->get('locale'),$locales_list)) {

                /*
                 * Set the Laravel locale
                 */
                app()->setLocale(session()->get('locale'));

                /*
                 * setLocale for php. Enables ->formatLocalized() with localized values for dates
                 */
                setlocale(LC_TIME,array_search(session()->get('locale'),$locales_list));

                /*
                 * setLocale to use Carbon source locales. Enables diffForHumans() localized
                 */
                Carbon::setLocale(array_search(session()->get('locale'),$locales_list));

                /*
                 * Set the session variable for whether or not the app is using RTL support
                 * for the current language being selected
                 * For use in the blade directive in BladeServiceProvider
                 */
                $locale_data = $locales->where('short_name','=',session()->get('locale'))->first();
                if ($locale_data->display_type == 'rtl') {
                    session(['display_type' => 'rtl']);
                } else {
                    session(['display_type' => 'ltr']);

//                    session()->forget('display_type');
                }
            }
        }

        return $next($request);
    }
}
