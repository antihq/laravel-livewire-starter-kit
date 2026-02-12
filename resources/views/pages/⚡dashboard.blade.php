<?php

use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component
{
    public string $sortBy = 'date';

    public string $sortDirection = 'desc';

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

    #[Computed]
    public function inventory(): array
    {
        return [
            (object) [
                'id' => 1,
                'product' => 'Wireless Bluetooth Earbuds',
                'quantity' => 45,
            ],
            (object) [
                'id' => 2,
                'product' => 'USB-C Charging Cable',
                'quantity' => 120,
            ],
            (object) [
                'id' => 3,
                'product' => 'Laptop Stand (Aluminum)',
                'quantity' => 23,
            ],
            (object) [
                'id' => 4,
                'product' => 'Mechanical Keyboard',
                'quantity' => 87,
            ],
            (object) [
                'id' => 5,
                'product' => 'Wireless Mouse',
                'quantity' => 56,
            ],
        ];
    }
};
?>

<div class="grid max-[600px]:grid-cols-1 grid-cols-2 max-w-7xl mx-auto gap-6">
    <div
        class="focus-none starting-style-transition relative mb-8 w-full overflow-x-auto overscroll-x-contain rounded-2xl bg-zinc-100 p-1.75 max-[600px]:p-1.25 dark:bg-zinc-950/35 dark:inset-shadow-2xs dark:inset-shadow-black [&:has(>[data-ui-panel-header])]:pt-0"
    >
        <div class="pl-3 flex justify-between items-center">
            <flux:heading level="1" size="lg">Orders</flux:heading>
            <div class="flex gap-2">
                <flux:button icon="ellipsis-horizontal" variant="subtle" />
                <flux:button>Create order</flux:button>
            </div>
        </div>
        <flux:table class="mt-1.75 max-[600px]:mt-1.25">
            <flux:table.rows>
                @foreach ($this->orders as $order)
                    <flux:table.row :key="$order->id">
                        <flux:table.cell
                            variant="strong"
                            class="border-t bg-white first:border-l first:pl-3 in-[tr:first-child]:first:rounded-tl-2xl in-[tr:last-child]:border-b in-[tr:last-child]:first:rounded-bl-2xl"
                        >
                            {{ $order->customer }}
                        </flux:table.cell>
                        <flux:table.cell
                            align="end"
                            class="bg-white last:border-r in-[tr:first-child]:border-t in-[tr:first-child]:last:rounded-tr-2xl in-[tr:last-child]:border-b in-[tr:last-child]:last:rounded-br-2xl last:pr-3"
                        >
                            {{ $order->date }}
                        </flux:table.cell>
                    </flux:table.row>
                @endforeach
            </flux:table.rows>
        </flux:table>
    </div>
    <div
        class="focus-none starting-style-transition relative mb-8 w-full overflow-x-auto overscroll-x-contain rounded-2xl bg-zinc-100 p-1.75 max-[600px]:p-1.25 dark:bg-zinc-950/35 dark:inset-shadow-2xs dark:inset-shadow-black [&:has(>[data-ui-panel-header])]:pt-0"
    >
        <div class="pl-3 flex justify-between items-center">
            <flux:heading level="1" size="lg">Inventory</flux:heading>
            <div class="flex gap-2">
                <flux:button icon="ellipsis-horizontal" variant="subtle" />
                <flux:button>Add item</flux:button>
            </div>
        </div>
        <flux:table class="mt-1.75 max-[600px]:mt-1.25">
            <flux:table.rows>
                @foreach ($this->inventory as $item)
                    <flux:table.row :key="$item->id">
                        <flux:table.cell
                            variant="strong"
                            class="border-t bg-white first:border-l first:pl-3 in-[tr:first-child]:first:rounded-tl-2xl in-[tr:last-child]:border-b in-[tr:last-child]:first:rounded-bl-2xl"
                        >
                            {{ $item->product }}
                        </flux:table.cell>
                        <flux:table.cell
                            align="end"
                            class="bg-white last:border-r in-[tr:first-child]:border-t in-[tr:first-child]:last:rounded-tr-2xl in-[tr:last-child]:border-b in-[tr:last-child]:last:rounded-br-2xl last:pr-3"
                        >
                            {{ $item->quantity }}
                        </flux:table.cell>
                    </flux:table.row>
                @endforeach
            </flux:table.rows>
        </flux:table>
    </div>
</div>
