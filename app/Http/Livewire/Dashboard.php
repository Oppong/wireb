<?php

namespace App\Http\Livewire;

use App\Models\Transaction;
use Livewire\Component;
use Livewire\WithPagination;

class Dashboard extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'title';
    public $sortDirection = 'asc';
    public $showModalEdit = false;
    public $showNew = false;
    public $showFilters = false;

    public Transaction $editing;

    public $filters = [
        'status' => '',
        'amount-min' => null,
        'amount-max' => null,
        'date-max' => null,
        'date-min' => null,
    ];

    protected $queryString = ['sortField', 'sortDirection'];

    public function mount()
    {
        $this->editing = Transaction::make();
    }

    public function rules()
    {

        return [
            'editing.title' => 'required',
            'editing.amount' => 'required',
            'editing.status' => 'required|in:' . collect(Transaction::STATUSES)->keys()->implode(','),
            'editing.dated' => 'required',
        ];
    }

    public function render()
    {

        // sleep(2);
        //searching the simple way
        $transaction = Transaction::query()
            ->where('title', 'like', '%' . $this->search . '%')
            ->orWhere('amount', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(20);

        //searching the advanced way method one
        $transactionss = Transaction::query()
            ->when($this->filters['status'], function ($query) {
                $query->where('status', $this->filters['status']);
            })
            ->where('title', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(20);

            //method two when searching
        $transactions = Transaction::query()
            ->when($this->filters['status'], function ($query, $status) {
                $query->where('status', $status);
            })
            ->where('title', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(20);





        return view('livewire.dashboard', [
            'transactions' => $transactions,
        ])->extends('layouts.app')
            ->section('content');
    }


    //sorting by field
    public function sortBy($field)
    {

        if ($this->sortField === $field) {

            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
    }



    // create a model transaction
    public function create()
    {
        // $this->editing = Transaction::make();
        if ($this->editing->getKey()) $this->editing = Transaction::make(['status' => 'processing ']);
        // $this->editing = Transaction::make(['status' => 'processing ']);
        $this->showModalEdit = true;
        $this->showNew = true;
    }


    //edit an individual transaction
    public function edit(Transaction $transactionId)
    {
        if ($this->editing->isNot($transactionId))  $this->editing = $transactionId;
        // $this->editing = $transactionId;
        $this->showModalEdit = true;
        $this->showNew = false;
    }

    public function save()
    {
        $this->validate();
        $this->editing->save();
        $this->showModalEdit = false;
    }

    public function resetFilters()
    {
        $this->reset('filters');
    }
}



// protected $rules = [
    //     'editing.title' => 'required',
    //     'editing.amount' => 'required',
    //     'editing.status' => 'required|',
    //     'editing.dated' => 'required',
    // ];
