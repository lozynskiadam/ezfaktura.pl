<table id="{{ $name }}" class="table dataTable"></table>

@section('scripts')
  @parent
  <script>
    window.addEventListener('load', (event) => {
      App.addDataTable('{{ $name }}', '{!!  @addslashes($dataTable->getJSON()) !!}');
    });
  </script>
@stop