<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="fa fa-dashboard nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
<li class=nav-item><a class=nav-link href="{{ backpack_url('elfinder') }}"><i class="nav-icon fa fa-files-o"></i> <span>{{ trans('backpack::crud.file_manager') }}</span></a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('tour') }}'><i class='nav-icon fa fa-database'></i> Tours</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('tour_guides') }}'><i class='nav-icon fa fa-database'></i> Points</a></li>

<li class='nav-item'><a class='nav-link' href='{{ backpack_url('country') }}'><i class='nav-icon fa fa-question'></i> Countries</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('city') }}'><i class='nav-icon fa fa-question'></i> Cities</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('language') }}'><i class='nav-icon fa fa-question'></i> Languages</a></li>
{{--<li class='nav-item'><a class='nav-link' href='{{ backpack_url('tour_guides_langs') }}'><i class='nav-icon fa fa-question'></i> Tour_guides_langs</a></li>--}}

{{--<li class='nav-item'><a class='nav-link' href='{{ backpack_url('tour_points') }}'><i class='nav-icon fa fa-question'></i> Tour_points</a></li>--}}

{{--<li class='nav-item'><a class='nav-link' href='{{ backpack_url('tour_country_city_lang') }}'><i class='nav-icon fa fa-question'></i> Tour_country_city_langs</a></li>--}}
