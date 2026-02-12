<?php

use Livewire\Attributes\Computed;
use Livewire\Attributes\Session;
use Livewire\Component;

new class extends Component
{
    public string $sortBy = 'date';

    public string $sortDirection = 'desc';

    #[Session]
    public array $displayedColumns = ['customer', 'date', 'amount'];

    public function updatedDisplayedColumns(): void
    {
        if (empty($this->displayedColumns)) {
            $this->reset('displayedColumns');
        }
    }

    public function sort(string $column): void
    {
        if ($this->sortBy === $column) {
            $this->sortDirection =
                $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $column;
            $this->sortDirection = 'asc';
        }
    }

    #[Computed]
    public function orders(): array
    {
        $orders = [
            (object) [
                'id' => 1,
                'customer' => 'Lindsey Aminoff',
                'date' => 'Jul 29, 10:45 AM',
                'status' => 'Paid',
                'status_color' => 'green',
                'amount' => '$49.00',
            ],
            (object) [
                'id' => 2,
                'customer' => 'Hanna Lubin',
                'date' => 'Jul 28, 2:15 PM',
                'status' => 'Paid',
                'status_color' => 'green',
                'amount' => '$312.00',
            ],
            (object) [
                'id' => 3,
                'customer' => 'Kianna Bushevi',
                'date' => 'Jul 30, 4:05 PM',
                'status' => 'Refunded',
                'status_color' => 'zinc',
                'amount' => '$132.00',
            ],
            (object) [
                'id' => 4,
                'customer' => 'Gustavo Geidt',
                'date' => 'Jul 27, 9:30 AM',
                'status' => 'Paid',
                'status_color' => 'green',
                'amount' => '$31.00',
            ],
            (object) [
                'id' => 5,
                'customer' => 'Emma Johnson',
                'date' => 'Jul 26, 11:20 AM',
                'status' => 'Pending',
                'status_color' => 'yellow',
                'amount' => '$89.00',
            ],
            (object) [
                'id' => 6,
                'customer' => 'Michael Chen',
                'date' => 'Jul 29, 3:45 PM',
                'status' => 'Paid',
                'status_color' => 'green',
                'amount' => '$156.00',
            ],
            (object) [
                'id' => 7,
                'customer' => 'Sarah Williams',
                'date' => 'Jul 25, 2:30 PM',
                'status' => 'Refunded',
                'status_color' => 'zinc',
                'amount' => '$78.00',
            ],
            (object) [
                'id' => 8,
                'customer' => 'James Rodriguez',
                'date' => 'Jul 28, 10:15 AM',
                'status' => 'Paid',
                'status_color' => 'green',
                'amount' => '$245.00',
            ],
            (object) [
                'id' => 9,
                'customer' => 'Olivia Davis',
                'date' => 'Jul 30, 1:00 PM',
                'status' => 'Pending',
                'status_color' => 'yellow',
                'amount' => '$67.00',
            ],
            (object) [
                'id' => 10,
                'customer' => 'David Martinez',
                'date' => 'Jul 27, 4:30 PM',
                'status' => 'Paid',
                'status_color' => 'green',
                'amount' => '$198.00',
            ],
            (object) [
                'id' => 11,
                'customer' => 'Emily Brown',
                'date' => 'Jul 26, 9:00 AM',
                'status' => 'Paid',
                'status_color' => 'green',
                'amount' => '$112.00',
            ],
            (object) [
                'id' => 12,
                'customer' => 'Daniel Wilson',
                'date' => 'Jul 29, 5:45 PM',
                'status' => 'Refunded',
                'status_color' => 'zinc',
                'amount' => '$87.00',
            ],
            (object) [
                'id' => 13,
                'customer' => 'Sophia Taylor',
                'date' => 'Jul 25, 11:30 AM',
                'status' => 'Paid',
                'status_color' => 'green',
                'amount' => '$234.00',
            ],
            (object) [
                'id' => 14,
                'customer' => 'Matthew Anderson',
                'date' => 'Jul 28, 2:00 PM',
                'status' => 'Pending',
                'status_color' => 'yellow',
                'amount' => '$156.00',
            ],
            (object) [
                'id' => 15,
                'customer' => 'Ava Thomas',
                'date' => 'Jul 30, 8:30 AM',
                'status' => 'Paid',
                'status_color' => 'green',
                'amount' => '$93.00',
            ],
            (object) [
                'id' => 16,
                'customer' => 'Joseph Jackson',
                'date' => 'Jul 27, 3:15 PM',
                'status' => 'Paid',
                'status_color' => 'green',
                'amount' => '$278.00',
            ],
            (object) [
                'id' => 17,
                'customer' => 'Isabella White',
                'date' => 'Jul 26, 10:45 AM',
                'status' => 'Refunded',
                'status_color' => 'zinc',
                'amount' => '$45.00',
            ],
            (object) [
                'id' => 18,
                'customer' => 'Andrew Harris',
                'date' => 'Jul 29, 12:30 PM',
                'status' => 'Paid',
                'status_color' => 'green',
                'amount' => '$167.00',
            ],
            (object) [
                'id' => 19,
                'customer' => 'Mia Clark',
                'date' => 'Jul 25, 4:00 PM',
                'status' => 'Pending',
                'status_color' => 'yellow',
                'amount' => '$89.00',
            ],
            (object) [
                'id' => 20,
                'customer' => 'Ethan Lewis',
                'date' => 'Jul 28, 9:15 AM',
                'status' => 'Paid',
                'status_color' => 'green',
                'amount' => '$203.00',
            ],
        ];

        $compareFn = match ($this->sortBy) {
            'customer' => fn ($a, $b) => strnatcasecmp(
                $a->customer,
                $b->customer,
            ),
            'date' => fn ($a, $b) => strcmp($a->date, $b->date),
            'status' => fn ($a, $b) => strcmp($a->status, $b->status),
            'amount' => fn ($a, $b) => (float) str_replace(
                ['$', ','],
                '',
                $a->amount,
            ) <=> (float) str_replace(['$', ','], '', $b->amount),
            default => fn ($a, $b) => $a->id <=> $b->id,
        };

        usort($orders, $compareFn);

        return $this->sortDirection === 'desc'
            ? array_reverse($orders)
            : $orders;
    }
};
?>

<div class="max-w-7xl mx-auto">
    <flux:heading level="1" size="xl">Orders</flux:heading>
    <div class="flex justify-between gap-8 mt-8">
        <flux:input placeholder="Search" />
        <div>
            <flux:dropdown>
                <flux:button icon:trailing="adjustments-vertical" />
                <flux:menu keep-open>
                    <flux:menu.checkbox.group wire:model.live="displayedColumns">
                        <flux:menu.checkbox value="customer">Customer</flux:menu.checkbox>
                        <flux:menu.checkbox value="date">Date</flux:menu.checkbox>
                        <flux:menu.checkbox value="status">Status</flux:menu.checkbox>
                        <flux:menu.checkbox value="amount">Amount</flux:menu.checkbox>
                    </flux:menu.checkbox.group>
                </flux:menu>
            </flux:dropdown>
        </div>
    </div>
    <div
        class="focus-none starting-style-transition relative mb-8 mt-8 w-full overflow-x-auto overscroll-x-contain rounded-2xl bg-zinc-100 p-1.75 max-[600px]:p-1.25 dark:bg-zinc-950/35 dark:inset-shadow-2xs dark:inset-shadow-black [&:has(>[data-ui-panel-header])]:pt-0"
    >
        <flux:table>
            <flux:table.columns>
                @if(in_array('customer', $displayedColumns))
                    <flux:table.column
                        sortable
                        :sorted="$sortBy === 'customer'"
                        :direction="$sortDirection"
                        wire:click="sort('customer')"
                        class="border-0! first:pl-3"
                    >
                        Customer
                    </flux:table.column>
                @endif
                @if(in_array('date', $displayedColumns))
                    <flux:table.column
                        sortable
                        :sorted="$sortBy === 'date'"
                        :direction="$sortDirection"
                        wire:click="sort('date')"
                        class="border-0! first:pl-3"
                    >
                        Date
                    </flux:table.column>
                @endif
                @if(in_array('status', $displayedColumns))
                    <flux:table.column
                        sortable
                        :sorted="$sortBy === 'status'"
                        :direction="$sortDirection"
                        wire:click="sort('status')"
                        class="border-0! first:pl-3"
                    >
                        Status
                    </flux:table.column>
                @endif
                @if(in_array('amount', $displayedColumns))
                    <flux:table.column
                        sortable
                        :sorted="$sortBy === 'amount'"
                        :direction="$sortDirection"
                        wire:click="sort('amount')"
                        class="border-0! first:pl-3"
                    >
                        Amount
                    </flux:table.column>
                @endif
            </flux:table.columns>
            <flux:table.rows>
                @foreach ($this->orders as $order)
                    <flux:table.row :key="$order->id">
                        @if(in_array('customer', $displayedColumns))
                            <flux:table.cell
                                class="border-t bg-white first:border-l first:pl-3 in-[tr:first-child]:first:rounded-tl-2xl in-[tr:last-child]:border-b in-[tr:last-child]:first:rounded-bl-2xl last:border-r in-[tr:first-child]:border-t in-[tr:first-child]:last:rounded-tr-2xl in-[tr:last-child]:last:rounded-br-2xl"
                            >
                                {{ $order->customer }}
                            </flux:table.cell>
                        @endif
                        @if(in_array('date', $displayedColumns))
                            <flux:table.cell
                                class="bg-white whitespace-nowrap in-[tr:first-child]:border-t in-[tr:last-child]:border-b  last:border-r  in-[tr:first-child]:last:rounded-tr-2xl  in-[tr:last-child]:last:rounded-br-2xl border-t first:border-l first:pl-3 in-[tr:first-child]:first:rounded-tl-2xl in-[tr:last-child]:first:rounded-bl-2xl"
                            >
                                {{ $order->date }}
                            </flux:table.cell>
                        @endif
                        @if(in_array('status', $displayedColumns))
                            <flux:table.cell
                                class="bg-white in-[tr:first-child]:border-t in-[tr:last-child]:border-b  last:border-r  in-[tr:first-child]:last:rounded-tr-2xl  in-[tr:last-child]:last:rounded-br-2xl border-t first:border-l first:pl-3 in-[tr:first-child]:first:rounded-tl-2xl in-[tr:last-child]:first:rounded-bl-2xl"
                            >
                                <flux:badge
                                    size="sm"
                                    :color="$order->status_color"
                                    inset="top bottom"
                                >
                                    {{ $order->status }}
                                </flux:badge>
                            </flux:table.cell>
                        @endif
                        @if(in_array('amount', $displayedColumns))
                            <flux:table.cell
                                variant="strong"
                                class="bg-white in-[tr:first-child]:border-t in-[tr:last-child]:border-b  last:border-r  in-[tr:first-child]:last:rounded-tr-2xl  in-[tr:last-child]:last:rounded-br-2xl border-t first:border-l first:pl-3 in-[tr:first-child]:first:rounded-tl-2xl in-[tr:last-child]:first:rounded-bl-2xl"
                            >
                                {{ $order->amount }}
                            </flux:table.cell>
                        @endif
                    </flux:table.row>
                @endforeach
            </flux:table.rows>
        </flux:table>
    </div>
</div>
