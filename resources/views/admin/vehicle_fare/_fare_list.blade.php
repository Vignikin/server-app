<ul class="nav nav-tabs" id="zoneTabs" role="tablist">
    @php
    $zoneNames = [];
    $zoneIndex = 0;
    @endphp
    @foreach ($results as $key => $result)
    @php
    $zoneName = $result->zoneType->zone->name;
    if (!in_array($zoneName, $zoneNames)) {
        $zoneNames[] = $zoneName;
    }
    @endphp
    @endforeach
    @foreach ($zoneNames as $zoneName)
    <li class="nav-item" role="presentation">
        <a class="nav-link @if ($zoneIndex === 0) active @endif" id="zone-tab-{{ $zoneIndex }}" data-toggle="tab" href="#zone-{{ $zoneIndex }}" role="tab" aria-controls="zone-{{ $zoneIndex }}" aria-selected="true">{{ $zoneName }}</a>
    </li>
    @php
    $zoneIndex++;
    @endphp
    @endforeach
</ul>

<div class="tab-content" id="zoneTabsContent">
    @php
    $zoneIndex = 0;
    @endphp
    @foreach ($zoneNames as $zoneName)
    <div class="tab-pane fade @if ($zoneIndex === 0) show active @endif" id="zone-{{ $zoneIndex }}" role="tabpanel">
        <table class="table table-hover">
            <!-- Table Header -->
            <thead>
                <!-- Header Rows -->
                <tr>
                    <!-- Header Columns -->
                    <th>@lang('view_pages.s_no')</th>
                    <th>@lang('view_pages.transport_type')</th>
                    <th>@lang('view_pages.vehicle_type')</th>
                    <th>@lang('view_pages.price_type')</th>
                    <th>@lang('view_pages.status')</th>
                    <th>@lang('view_pages.action')</th>
                </tr>
            </thead>
            <!-- Table Body -->
            <tbody>
                @php
                $i = 1;
                @endphp
                @foreach ($results as $key => $result)
                @if ($result->zoneType->zone->name === $zoneName)
                <!-- Data Rows -->
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ ($result->zoneType->transport_type) }}</td>
                    <td>{{ $result->zoneType->vehicleType->name }}</td>
                    <td>
                        @if ($result->price_type == 1)
                        <span class="btn btn-success btn-sm">{{ __('view_pages.ride_now') }}</span>
                        @else
                        <span class="btn btn-danger btn-sm">{{ __('view_pages.ride_later') }}</span>
                        @endif
                    </td>
                    <td>
                        @if ($result->zoneType->active)
                        <button class="btn btn-success btn-sm">@lang('view_pages.active')</button>
                        @else
                        <button class="btn btn-danger btn-sm">@lang('view_pages.inactive')</button>
                        @endif
                    </td>
                    <td>
                        <!-- Dropdown for Actions -->
                        <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('view_pages.action')</button>
                        <div class="dropdown-menu w-48">
                            <a class="dropdown-item" href="{{url('vehicle_fare/edit', $result->id)}}">
                                <i class="fa fa-pencil"></i>@lang('view_pages.edit')
                            </a>
                            <a class="dropdown-item" href="{{url('vehicle_fare/rental_package/index', $result->zoneType->id)}}">
                                <i class="fa fa-plus"></i>@lang('view_pages.assign_rental_package')
                            </a>
                            @if ($result->active == 1 && $result->zoneType->zone->default_vehicle_type != $result->zoneType->vehicleType->id)
                            <a class="dropdown-item" href="{{url('vehicle_fare/set/default',$result->id)}}"><i class="fa fa-dot-circle-o"></i>@lang('view_pages.set_as_default')</a>
                            @endif
                            @if($result->zoneType->active)
                            <a class="dropdown-item" href="{{url('vehicle_fare/toggle_status', $result->id)}}">
                                <i class="fa fa-dot-circle-o"></i>@lang('view_pages.inactive')</a>
                            @else
                            <a class="dropdown-item" href="{{url('vehicle_fare/toggle_status', $result->id)}}">
                                <i class="fa fa-dot-circle-o"></i>@lang('view_pages.active')</a>
                            @endif
                            <a class="dropdown-item sweet-delete" href="#" data-url="{{url('vehicle_fare/delete',$result->id)}}">
                                <i class="fa fa-trash-o"></i>@lang('view_pages.delete')</a>
                        </div>
                    </td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
    </div>
    @php
    $zoneIndex++;
    @endphp
    @endforeach
</div>
