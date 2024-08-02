<x-utils.edit-button :href="route('admin.structure.activity.edit', $activity)" />
<x-utils.form-button
    :action="route('admin.structure.activity.copy', $activity)"
    name="confirm-item"
    button-class="btn btn-primary btn-sm"
>
    <i class="fas fa-copy"></i> {{ __('Copiar') }}
</x-utils.form-button>
<x-utils.delete-button :href="route('admin.structure.activity.destroy', $activity)" />
