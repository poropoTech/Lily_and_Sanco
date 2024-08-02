<form method="post" {{ $attributes->merge(['action' => '#', 'class' => 'form-horizontal', 'enctype' => 'application/x-www-form-urlencoded']) }}>
    @csrf

    {{ $slot }}
</form>
