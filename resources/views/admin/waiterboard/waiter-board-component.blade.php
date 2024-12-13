<div>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper kanban">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6">
              <h1>Order Board</h1>
            </div>
            <div class="col-sm-6 d-none d-sm-block">
            </div>
          </div>
        </div>
      </section>
  
      <section class="content pb-3">
        <div class="container-fluid h-100">
  
          <div class="card card-row card-primary">
            <div class="card-header">
              <h3 class="card-title">
                In Progress
              </h3>
            </div>
            <div class="card-body">
                @foreach ($orders->where('status', 'in_progress') as $order)
                  <div class="card card-info card-outline">
                    <div class="card-header">
                      <h5 class="card-title">Order {{$order->queue}}</h5>
                    </div>
                    {{-- <div class="card-body">
                        @foreach ($order->orderItems as $item)
                          <div class="custom-control custom-checkbox">
                              <input class="custom-control-input" wire:change="switchOrderItemStatus({{$order->id}}, {{$item->id}})" type="checkbox" id="checkbox-{{$order->id}}-{{$item->id}}" {{$item->status === 'done' ? 'checked disabled' : ''}}>
  
                              <input class="custom-control-input" type="checkbox" id="checkbox-{{$order->id}}-{{$item->id}}">
                              <label for="checkbox-{{$order->id}}-{{$item->id}}" class="custom-control-label">{{$item->food->name}}</label>
                          </div>               
                        @endforeach
                    </div> --}}
                  </div>
                @endforeach
            </div>
          </div>
  
          <div class="card card-row card-default">
            <div class="card-header bg-info">
              <h3 class="card-title">
                Done
              </h3>
            </div>
            <div class="card-body">
              @foreach ($orders->where('status', 'done') as $order)
              <div class="card card-info card-outline">
                  <div class="card-header">
                    <h5 class="card-title">Order {{$order->queue}}</h5>
                    <div class="card-tools">
                      <a href="#" wire:click="switchOrderStatus({{$order->id}}, 'in_hand')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-caret-right-square-fill text-success mr-2 " viewBox="0 0 16 16">
                          <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm5.5 10a.5.5 0 0 0 .832.374l4.5-4a.5.5 0 0 0 0-.748l-4.5-4A.5.5 0 0 0 5.5 4z"/>
                        </svg>
                      </a>
                    </div>
                  </div>
                  <div class="card-body">
                      @foreach ($order->orderItems as $item)
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" wire:change="switchOrderItemStatus({{$order->id}}, {{$item->id}})" type="checkbox" id="checkbox-{{$order->id}}-{{$item->id}}" {{$item->status === 'done' ? 'checked disabled' : ''}}>
                          <label for="checkbox-{{$order->id}}-{{$item->id}}" class="custom-control-label">{{$item->food->name}}</label>
                        </div>                
                      @endforeach
                  </div>
                </div>
            @endforeach
            </div>
          </div>
  
          <div class="card card-row card-success">
            <div class="card-header">
              <h3 class="card-title">
                In Hand
              </h3>
            </div>
            
            <div class="card-body">
                @foreach ($orders->where('status', 'in_hand') as $order)
                  <div class="card card-info card-outline">
                    <div class="card-header">
                      <h5 class="card-title">Order {{$order->queue}}</h5>
                      {{-- <div class="card-tools">
                        <a href="#" wire:click="switchOrderStatus({{$order->id}}, 'done')">
                          <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-caret-left-square-fill text-danger mr-2" viewBox="0 0 16 16">
                            <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm10.5 10V4a.5.5 0 0 0-.832-.374l-4.5 4a.5.5 0 0 0 0 .748l4.5 4A.5.5 0 0 0 10.5 12"/>
                          </svg>
                        </a>
                        <a href="#" wire:click="switchOrderStatus({{$order->id}}, 'completed')">
                          <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-caret-right-square-fill text-success mr-2 " viewBox="0 0 16 16">
                            <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm5.5 10a.5.5 0 0 0 .832.374l4.5-4a.5.5 0 0 0 0-.748l-4.5-4A.5.5 0 0 0 5.5 4z"/>
                          </svg>
                        </a>
                      </div> --}}
                    </div>
                    <div class="card-body">
                        @foreach ($order->orderItems as $item)
                          <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" wire:change="switchOrderItemStatus({{$order->id}}, {{$item->id}})" type="checkbox" id="checkbox-{{$order->id}}-{{$item->id}}" {{$item->status === 'done' ? 'checked disabled' : ''}}>
  
                            {{-- <input class="custom-control-input" type="checkbox" id="checkbox-{{$order->id}}-{{$item->id}}"> --}}
                            <label for="checkbox-{{$order->id}}-{{$item->id}}" class="custom-control-label">{{$item->food->name}}</label>
                          </div>                    
                        @endforeach
                    </div>
                  </div>
                @endforeach
            </div>
          </div>
        </div>
      </section>
  </div>
  