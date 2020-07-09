@extends('layouts.master')
@section('main-content')
<div class="col-12 col-sm-12">
    <div class="card card-primary card-outline card-outline-tabs">
        <div class="card-header p-0 border-bottom-0">
        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
            <li class="nav-item">
            <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#requirementDetailsTab" role="tab" aria-controls="requirementDetailsTab" aria-selected="true">Requirement Details</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#assignVendorTab" role="tab" aria-controls="assignVendorTab" aria-selected="false">Assign Vendor</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill" href="#paymentTab" role="tab" aria-controls="paymentTab" aria-selected="false">Payment</a>
            </li>
        </ul>
        </div>
        <div class="card-body">
        <div class="tab-content" id="custom-tabs-four-tabContent">
            <div class="tab-pane fade show active" id="requirementDetailsTab" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                <table>
                    <tr>
                        <th>Title</th>
                        <td></td>
                    </tr>
                    <tr>
                        <th>Category</th>
                        <td></td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td></td>
                    </tr>
                    <tr>
                        <th>Spacial Remark</th>
                        <td></td>
                    </tr>
                    <tr>
                        <th>Proposal Document(if any)</th>
                        <td></td>
                    </tr>
                    <tr>
                        <th>Prority</th>
                        <td></td>
                    </tr>
                </table>
            </div>
            <div class="tab-pane fade" id="assignVendorTab" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                121Mauris tincidunt mi at erat gravida, eget tristique urna bibendum. Mauris pharetra purus ut ligula tempor, et vulputate metus facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Maecenas sollicitudin, nisi a luctus interdum, nisl ligula placerat mi, quis posuere purus ligula eu lectus. Donec nunc tellus, elementum sit amet ultricies at, posuere nec nunc. Nunc euismod pellentesque diam.
            </div>
            <div class="tab-pane fade" id="paymentTab" role="tabpanel" aria-labelledby="custom-tabs-four-messages-tab">
                222Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus volutpat augue id mi placerat mollis. Vivamus faucibus eu massa eget condimentum. Fusce nec hendrerit sem, ac tristique nulla. Integer vestibulum orci odio. Cras nec augue ipsum. Suspendisse ut velit condimentum, mattis urna a, malesuada nunc. Curabitur eleifend facilisis velit finibus tristique. Nam vulputate, eros non luctus efficitur, ipsum odio volutpat massa, sit amet sollicitudin est libero sed ipsum. Nulla lacinia, ex vitae gravida fermentum, lectus ipsum gravida arcu, id fermentum metus arcu vel metus. Curabitur eget sem eu risus tincidunt eleifend ac ornare magna.
            </div>

        </div>
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection
