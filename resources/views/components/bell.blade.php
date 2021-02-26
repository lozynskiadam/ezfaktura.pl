<li class="nav-item dropdown hidden-caret">
  <a class="nav-link dropdown-toggle" href="#" id="bell" role="button" data-toggle="dropdown">
    <i class="fa fa-bell" data-number="{{ $number }}"></i>
    <span class="counter">@if ($number > 0) {{ $number }} @endif</span>
  </a>
  <ul class="dropdown-menu notif-box animated slideIn" aria-labelledby="bell">
    <li>
      <div class="dropdown-title">{{ __('translations.notifications.list') }}</div>
    </li>
    <li>
      <div class="notif-scroll scrollbar-outer">
        <div class="notif-center"></div>
      </div>
    </li>
    <li class="p-1"></li>
  </ul>
</li>

@section('scripts')
  @parent
  <script>
    window.addEventListener('load', (event) => {
      $('#bell', document).on('click', function () {
        let $content = $('.notif-center', document);
        $content.html('<a href="#" class="p-2"><i class="fa fa-sync-alt fa-spin fa-2x m-auto"></i></a>');
        $.ajax({
          method: "GET",
          url: "/notifications/list",
          dataType: 'json',
          success: function (data) {
            let html = [];
            for (const item of data) {
              item.is_confirmed ? html.push('<a href="#" class="confirmed">') : html.push('<a href="#">');
              html.push('	<div class="notif-icon text-' + item.class + '"><i class="' + item.icon + '"></i></div>');
              html.push('	<div class="notif-content">');
              html.push('		<span class="subject">' + item.title + '</span>');
              html.push('		<span class="block">' + item.message + '</span>');
              html.push('		<span class="time">' + item.date + '</span>');
              html.push('	</div>');
              html.push('</a>');
            }
            $content.html(html.join(''));
            $('#bell i.fa', document).attr('data-number', '0');
            $('#bell .counter', document).text('');
          },
        });
      });
    });
  </script>
@stop