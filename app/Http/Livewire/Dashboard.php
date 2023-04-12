<?php

namespace App\Http\Livewire;

use App\Models\Transaction;
use Carbon\Carbon;
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
    public $selected = [];

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


        //method three making it more awesome
        $transactions = Transaction::query()
            ->when($this->filters['status'], fn ($query, $status) =>$query->where('status', $status))
            ->when($this->filters['amount-min'], fn ($query, $amount) =>$query->where('amount', '>=', $amount))
            ->when($this->filters['amount-max'], fn ($query, $amount) =>$query->where('amount', '<=', $amount))
            ->when($this->filters['date-min'], fn ($query, $date) =>$query->where('dated', '>=', Carbon::parse($date)))
            ->when($this->filters['date-max'], fn ($query, $date) =>$query->where('dated', '<=', Carbon::parse($date)))
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


    public function updatedSearch()
    {
        $this->resetPage();
    }

    //bulk exports

    public function exportSelected(){

        return response()->streamDownload(function(){

            //used a macro for the csv
            echo Transaction::whereKey($this->selected)->toCsv();

        }, 'transactions.csv');
    }


    //bulk deletes
    public function deleteSelected(){

        $transactions = Transaction::whereKey($this->selected);
       $deleted = $transactions->delete();


       if($deleted){
        session()->flash('message', 'selected transactions deleted successfully');
       }else{

       }

    }
}





// protected $rules = [
    //     'editing.title' => 'required',
    //     'editing.amount' => 'required',
    //     'editing.status' => 'required|',
    //     'editing.dated' => 'required',
    // ];
