<div class="row">
    <div class="col-sm-4 pull-right">
        <div class="form-group text-right">
            <select class="form-control" name="show" id="showAdverts">
                <option disabled selected value="">-- {{ __('forms.show_adverts') }} --</option>
                <option @if(app('request')->input('show') == 'all') selected @endif value="all">{{ __('forms.all_in_this_category') }}</option>
                <option @if(app('request')->input('show') == 'for_today') selected @endif value="for_today">{{ __('forms.for_today') }}</option>
                <option @if(app('request')->input('show') == 'for_days_2') selected @endif value="for_days_2">{{ __('forms.for_2_days') }}</option>
                <option @if(app('request')->input('show') == 'for_days_5') selected @endif value="for_days_5">{{ __('forms.for_5_days') }}</option>
            </select>
        </div>
    </div>
</div>