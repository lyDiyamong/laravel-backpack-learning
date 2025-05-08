---
description: 
globs: 
alwaysApply: true
---
Here's a text-based **Livewire + Bootstrap coding rule guideline** tailored for use in a cursor code editor. You can save this as a `.md`, `.txt`, or use in documentation tooling.

---

## 🧠 Livewire + Bootstrap Coding Standards

### ✅ Core Principles
- Maintain **clean separation of concerns** between Blade views and Livewire components.
- Use **Bootstrap 5** utility classes for styling (no Tailwind).
- Leverage **Livewire’s lifecycle methods** for reactive UI updates.
- Keep Blade views lean – move logic into Livewire class.
- Follow **SOLID principles** and **Laravel best practices**.

---

### 📁 Folder & File Structure
- **Components** live in `app/Livewire`  
- **Views** live in `resources/views/livewire`  
- Component naming: `UserTable` → class `Livewire\UserTable.php`, view `livewire/user-table.blade.php`

---

### 📛 Naming Conventions
- Class: `PascalCase` (e.g., `UserForm`)
- View file: `kebab-case.blade.php`
- Livewire methods: `camelCase`
- Public properties: `snake_case` to bind easily with Blade

---

### ⚙️ Livewire Component Rules

#### File: `app/Livewire/ComponentName.php`
```php
<?php

declare(strict_types=1);

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Log;

final class ComponentName extends Component
{
    public string $name = '';

    public function mount(): void
    {
        // Initialize state
    }

    public function updated(string $property): void
    {
        // React to property change
    }

    public function save(): void
    {
        $this->validate([
            'name' => 'required|string|max:255',
        ]);

        // Perform save logic...
    }

    public function render(): View
    {
        return view('livewire.component-name');
    }
}
```

#### File: `resources/views/livewire/component-name.blade.php`
```blade
<div>
  <form wire:submit.prevent="save" class="needs-validation" novalidate>
    <div class="mb-3">
      <label for="name" class="form-label">Name</label>
      <input wire:model.lazy="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name">
      @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <button type="submit" class="btn btn-primary">Save</button>
  </form>
</div>
```

---

### 🧪 Validation
- Always use `$this->validate()` or `FormRequest` in `save()` method.
- Use Livewire’s `@error` for inline validation messages with Bootstrap’s `is-invalid` class.

---

### 🧩 Best Practices
- Use `wire:model.lazy` or `wire:model.debounce.500ms` to reduce unnecessary re-renders.
- For modals/forms, use Bootstrap modal JS with `wire:ignore.self` to prevent Livewire DOM conflict.
- Do not use Livewire components inside loops unless necessary (prefer @foreach for performance).

---

### ⚡️ Event Handling
- Use `dispatch()` in PHP and `@this.on()` in JavaScript for real-time interactions.
- Leverage Livewire’s `emit` and `listen` features for child-parent communication.

---

### 🚫 Avoid
- Avoid placing logic in Blade templates (e.g., `@php`)
- Avoid mutating properties outside lifecycle hooks/methods.
- Don’t mix Tailwind with Bootstrap for styling.

---

### 💾 Example Rule for Button with Loading State
```blade
<button wire:click="save" wire:loading.attr="disabled" class="btn btn-success">
  <span wire:loading.remove>Save</span>
  <span wire:loading>Saving...</span>
</button>
```

---

### ✅ Recommended Directives
- `wire:model.lazy` for inputs
- `wire:click` for buttons
- `wire:loading`, `wire:loading.class`, `wire:loading.attr`
- `@error('field')` for validation messages

---

Let me know if you want this converted into JSON for a custom linting tool, or integrated with a README structure.