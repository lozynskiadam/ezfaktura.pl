<table id="{{ $name }}" class="table dataTable"></table>

<script>
  window.addEventListener('load', (event) => {
    App.addDataTable('{{ $name }}', '{!!  @addslashes($dataTable->getJSON()) !!}');
  });
</script>