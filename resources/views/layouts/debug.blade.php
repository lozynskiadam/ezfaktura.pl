<style>
  .debug-menu {
    position: fixed;
    right: 15px;
    bottom: 15px;
  }
  .debug-item {
    float: left;
    background: #1d1d1d;
    box-shadow: 0 0 5px #22222288;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    margin: 5px;
    line-height: 50px;
    text-align: center;
    vertical-align: middle;
    font-size: 20px;
    color: #fff;
    cursor: pointer;
  }
</style>

<div class="debug-menu">
  <div class="debug-item" data-toggle="modal" data-target="#debug_db_modal">
    <i class="fa fa-database"></i>
  </div>
</div>

<div class="modal fade" id="debug_db_modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-wide" role="document">
    <div class="modal-content">
      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title">Query log</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table">
        @foreach(\Illuminate\Support\Facades\DB::getQueryLog() as $query)
          <tr>
            <td><B>{{ $query['time'] }}ms</B></td>
            <td>{{ $query['query'] }}</td>
          </tr>
        @endforeach
        </table>
      </div>
    </div>
  </div>
</div>