<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;



class UsersLivewire extends Component
{
    use WithFileUploads;

    use WithPagination;
    public $cardsPage = 1;
    protected string $paginationTheme = 'tailwind';
    protected $queryString = ['search', 'page'];

    public $search = '', $cards = true;
    public $isModalOpen = false;
    public $modalType = '';
    public $deleteId = '';
    public $userToView = '';
    public $updateUserId = '';
    public $id, $role_id = null, $name, $lastname, $email, $password, $address, $gender = null, $phone, $photo_path;

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($this->id),
            ],
            'address' => 'required|string|max:255',
            'phone' => 'required|numeric|digits_between:8,10',
            'gender' => 'required|in:male,female',
            'role_id' => 'required|in:1,2',
            'photo_path' => 'nullable|image|max:2048',
        ];
    }
    protected $messages = [
        'name.required' => 'El nombre es obligatorio.',
        'address.required' => 'La dirección es obligatoria.',
        'lastname.required' => 'Los apellidos son obligatorios.',
        'email.required' => 'El correo electrónico es obligatorio.',
        'email.email' => 'Por favor, introduce un correo válido.',
        'email.unique' => 'Este correo ya está en uso.',
        'phone.required' => 'El número de teléfono es obligatorio.',
        'phone.numeric' => 'El número de teléfono debe ser un valor numérico.',
        'gender.required' => 'Por favor, selecciona un género.',
        'role_id.required' => 'Por favor, selecciona un rol.',
        'photo_path.required' => 'El campo foto es obligatorio.',
    ];

    public function toogleModal()
    {
        $this->isModalOpen = !$this->isModalOpen;
    }

    public function toogleView()
    {
        $this->cards = !$this->cards;
    }

    public function viewUser($id)
    {
        $this->modalType = 'view';
        $this->toogleModal();
        $this->userToView = User::find($id);
    }

    public function confirmDelete($id)
    {
        $this->modalType = 'delete';
        $this->deleteId = $id;
        $this->toogleModal();
    }

    public function deleteUser($id)
    {
        User::find($id)->delete();
        $this->dispatch('show-toast', [
            'message' => 'Usuario eliminado correctamente.',
            'type' => 'success',
        ]);
        $this->toogleModal();
    }

    public function confirmUpdate($id)
    {
        $this->modalType = 'update';
        $this->toogleModal();
        $user = User::find($id);
        $this->id = $user->id;
        $this->name = $user->name;
        $this->lastname = $user->lastname;
        $this->email = $user->email;
        $this->address = $user->address;
        $this->gender = $user->gender;
        $this->role_id = $user->role_id;
        $this->phone = $user->phone;
        $this->photo_path = $user->photo_path;
    }

    public function updateUser($id)
    {
        $this->validate();
        if ($this->photo_path) {
            $photo_path = $this->photo_path->store('photos', 'public');
        } else {
            $photo_path = $this->photo_path;
        }
        User::whereId($id)->update([
            'role_id' => $this->role_id,
            'name' => $this->name,
            'lastname' => $this->lastname,
            'email' => $this->email,
            'address' => $this->address,
            'gender' => $this->gender,
            'phone' => $this->phone,
            'photo_path' => $photo_path,
        ]);
        $this->toogleModal();
    }
    public function render()
    {
        $pageName = $this->cards ? 'cardsPage' : 'tablePage';

        $users = User::query()
            ->where('name', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->orderBy('status', 'asc')
            ->paginate(10, ['*'], $pageName)
            ->withQueryString();
        // dd($users);
        return view('livewire.users-livewire', [
            'users' => $users,
        ])->layout('layouts.app');
    }
}
