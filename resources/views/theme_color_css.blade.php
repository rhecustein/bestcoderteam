@php
    $color = '';
    $selected_theme = Session::get('selected_theme');
    if ($selected_theme == 'theme_one'){
        $setting = App\Models\Setting::select('theme_one_color')->first();
        $color = $setting->theme_one_color;
    }elseif($selected_theme == 'theme_two'){
        $setting = App\Models\Setting::select('theme_two_color')->first();
        $color = $setting->theme_two_color;
    }elseif($selected_theme == 'theme_three'){
        $setting = App\Models\Setting::select('theme_three_color')->first();
        $color = $setting->theme_three_color;
    }else{
        $setting = App\Models\Setting::select('theme_one_color')->first();
        $color = $setting->theme_one_color;
    }
@endphp

<style>
.search_form {
    background: {{ $color }} !important;
}

:root {
    --colorPrimary: {{ $color }} !important;
}
</style>
