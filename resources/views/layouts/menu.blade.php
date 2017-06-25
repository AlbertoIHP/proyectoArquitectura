<li class="{{ Request::is('users*') ? 'active' : '' }}">
    <a href="{!! route('users.index') !!}"><i class="fa fa-edit"></i><span>Users</span></a>
</li>

<li class="{{ Request::is('workers*') ? 'active' : '' }}">
    <a href="{!! route('workers.index') !!}"><i class="fa fa-edit"></i><span>Workers</span></a>
</li>

<li class="{{ Request::is('spaceTypes*') ? 'active' : '' }}">
    <a href="{!! route('spaceTypes.index') !!}"><i class="fa fa-edit"></i><span>SpaceTypes</span></a>
</li>

<li class="{{ Request::is('spaces*') ? 'active' : '' }}">
    <a href="{!! route('spaces.index') !!}"><i class="fa fa-edit"></i><span>Spaces</span></a>
</li>

<li class="{{ Request::is('shiftTypes*') ? 'active' : '' }}">
    <a href="{!! route('shiftTypes.index') !!}"><i class="fa fa-edit"></i><span>ShiftTypes</span></a>
</li>

<li class="{{ Request::is('roles*') ? 'active' : '' }}">
    <a href="{!! route('roles.index') !!}"><i class="fa fa-edit"></i><span>Roles</span></a>
</li>

<li class="{{ Request::is('reservations*') ? 'active' : '' }}">
    <a href="{!! route('reservations.index') !!}"><i class="fa fa-edit"></i><span>Reservations</span></a>
</li>

<li class="{{ Request::is('payments*') ? 'active' : '' }}">
    <a href="{!! route('payments.index') !!}"><i class="fa fa-edit"></i><span>Payments</span></a>
</li>

<li class="{{ Request::is('maintenances*') ? 'active' : '' }}">
    <a href="{!! route('maintenances.index') !!}"><i class="fa fa-edit"></i><span>Maintenances</span></a>
</li>

<li class="{{ Request::is('maintainers*') ? 'active' : '' }}">
    <a href="{!! route('maintainers.index') !!}"><i class="fa fa-edit"></i><span>Maintainers</span></a>
</li>

<li class="{{ Request::is('expenses*') ? 'active' : '' }}">
    <a href="{!! route('expenses.index') !!}"><i class="fa fa-edit"></i><span>Expenses</span></a>
</li>

<li class="{{ Request::is('calendars*') ? 'active' : '' }}">
    <a href="{!! route('calendars.index') !!}"><i class="fa fa-edit"></i><span>Calendars</span></a>
</li>

<li class="{{ Request::is('buildings*') ? 'active' : '' }}">
    <a href="{!! route('buildings.index') !!}"><i class="fa fa-edit"></i><span>Buildings</span></a>
</li>

<li class="{{ Request::is('assistances*') ? 'active' : '' }}">
    <a href="{!! route('assistances.index') !!}"><i class="fa fa-edit"></i><span>Assistances</span></a>
</li>

<li class="{{ Request::is('articles*') ? 'active' : '' }}">
    <a href="{!! route('articles.index') !!}"><i class="fa fa-edit"></i><span>Articles</span></a>
</li>

<li class="{{ Request::is('apartments*') ? 'active' : '' }}">
    <a href="{!! route('apartments.index') !!}"><i class="fa fa-edit"></i><span>Apartments</span></a>
</li>

