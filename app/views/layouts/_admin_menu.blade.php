<li class="dropdown">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown">ADMINISTRATION <b class="caret"></b></a>
  <ul class="dropdown-menu">
    <li class="">{{ link_to_route('admin.home', 'DASHBOARD') }}</li>
    <li class="">{{ link_to_route('admin.registration.index', 'REGISTRATIONS') }}</li>
    <li class="">{{ link_to_route('admin.order.index', 'ORDERS') }}</li>
    <li class="">{{ link_to_route('admin.child.index', 'CHILDREN') }}</li>
    <li class="">{{ link_to_route('admin.voucher.index', 'VOUCHERS') }}</li>
    <li class="">{{ link_to_route('admin.faq.index', 'FAQS') }}</li>
    <li class="">{{ link_to_route('admin.user.index', 'USERS') }}</li>
  </ul>
</li>