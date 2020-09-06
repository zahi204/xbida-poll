<body style="background-color:white;"; class="vertical-layout vertical-menu-modern 2-columns {{ $configData['blankPageClass'] }} {{ $configData['bodyClass'] }}  {{($configData['theme'] === 'light') ? '' : $configData['theme'] }}  {{ $configData['navbarType'] }} {{ $configData['sidebarClass'] }} {{ $configData['footerType'] }}" data-menu="vertical-menu-modern" data-col="2-columns"  data-layout="{{ $configData['theme'] }}">
 

 <!-- BEGIN: Content-->
 <div class="app-content" style="margin:5px;";>
     <!-- BEGIN: Header-->
     <div class="content-overlay"></div>
     <div class=""></div>


     @if(!empty($configData['contentLayout']))
         <div class="content-area-wrapper">
             <div class="{{ $configData['sidebarPositionClass'] }}">
                 <div class="sidebar">
                     {{-- Include Sidebar Content --}}
                     @yield('content-sidebar')
                 </div>
             </div>
             <div class="{{ $configData['contentsidebarClass'] }}">
                 <div class="content-wrapper">
                     <div class="content-body">
                         {{-- Include Page Content --}}
                         @yield('content')
                     </div>
                 </div>
             </div>
         </div>
     @else
         <div class="content-wrapper">
             {{-- Include Breadcrumb --}}
             @if($configData['pageHeader'] == true)
                 @include('panels.breadcrumb')
             @endif

             <div class="content-body" style="height:200px;";>
                 {{-- Include Page Content --}}
                 @yield('content')
             </div>
         </div>
     @endif

 </div>
 <!-- End: Content-->



 <div class="sidenav-overlay"></div>
 <div class="drag-target"></div>


 {{-- include default scripts --}}
 @include('panels/scripts')

</body>
</html>
