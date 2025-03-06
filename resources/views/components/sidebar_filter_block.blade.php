<div class="ec-sidebar-block">
    <div class="ec-sb-title">
        <h3 class="ec-sidebar-title">{{ $title }}</h3>
    </div>
    <div class="ec-sb-block-content">
        <ul>

            @foreach ($specifications as $index => $specification)
           
                <li>
                    <div class="ec-sidebar-block-item">
                        <input type="checkbox" class="filter-checkbox" data-type="{{ $specification['type'] }}"
                            data-name="{{ $specification['name'] }}"
                            @if (isset($specification['value'])) data-value="{{ $specification['value'] }}" @endif
                            {{ $specification['checked'] ? 'checked' : '' }} />
                        <a href="#">{{ $specification['name'] }}</a>
                        <span class="checked"></span>
                    </div>
                </li>
            @endforeach


        </ul>
    </div>
</div>
