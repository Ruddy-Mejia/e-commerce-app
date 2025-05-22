<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;

use Livewire\Component;

class UsersAddLivewire extends Component
{
    use WithFileUploads;
    public $isModalOpen = false;
    public $role = null, $name, $lastname, $email, $password, $address, $gender = null, $phone, $photo_path;
    public $toastMessage = '';


    protected $rules = [
        'name' => 'required|string|max:255',
        'lastname' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'address' => 'required|string|max:255',
        'phone' => 'required|digits_between:8,10',
        'gender' => 'required|in:male,female',
        'role' => 'required|in:1,2',
        'photo_path' => 'required|image|max:2048',
    ];
    // protected $messages = [
    //     'name.required' => 'El nombre es obligatorio.',
    //     'address.required' => 'La dirección es obligatoria.',
    //     'lastname.required' => 'Los apellidos son obligatorios.',
    //     'email.required' => 'El correo electrónico es obligatorio.',
    //     'email.email' => 'Por favor, introduce un correo válido.',
    //     'email.unique' => 'Este correo ya está en uso.',
    //     'phone.required' => 'El número de teléfono es obligatorio.',
    //     'phone.numeric' => 'El número de teléfono debe ser un valor numérico.',
    //     'gender.required' => 'Por favor, selecciona un género.',
    //     'role.required' => 'Por favor, selecciona un rol.',
    //     'photo_path.required' => 'El campo foto es obligatorio.',
    // ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function openModal()
    {
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    public function resetForm()
    {
        $this->name = $this->lastname = $this->email = $this->password = $this->address = $this->phone = '';
        $this->role = $this->gender = null;
    }



    public function createUser()
    {
        $this->validate();
        if ($this->photo_path) {
            $photo_path = $this->photo_path->store('photos' ,'public');
        }
        User::create([
            'role_id' => $this->role,
            'name' => $this->name,
            'lastname' => $this->lastname,
            'email' => $this->email,
            'password' => Hash::make($this->name . $this->phone),
            'address' => $this->address,
            'gender' => $this->gender,
            'phone' => $this->phone,
            'photo_path' => $photo_path,
            'status' => 1,
        ]);

        $this->toastMessage = 'Usuario creado exitosamente';
        // $this->toastMessage = $photo_path;
        $this->closeModal();
        $this->resetForm();
    }

    public function render()
    {
        return view('livewire.users-add-livewire');
    }
}
