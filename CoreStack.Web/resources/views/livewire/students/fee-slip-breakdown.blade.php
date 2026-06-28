
<!-- Transaction Breakdown Container -->
<div class="max-w-4xl mx-auto bg-white rounded-xl shadow-md border border-stone-200 overflow-hidden p-8">
    


    <!-- Header Section (Scaled down for a cleaner footprint) -->
    <div class="flex flex-col items-center text-center border-b border-stone-100 pb-4 mb-4">
        <!-- Reduced School Logo Dimension (w-12 h-12) -->
        <div class="w-12 h-12 bg-darkblue rounded-full flex items-center justify-center shadow-sm mb-2 border border-gold">
            <svg class="w-6 h-6 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
            </svg>
        </div>
        <h1 class="text-base font-extrabold text-darkblue tracking-tight uppercase">CoreStack Academy</h1>
        <p class="text-[10px] font-bold text-gold uppercase tracking-widest mt-0.5">Official Transaction Receipt</p>
    </div>

    <!-- Student Metadata Info Panel (More compact text and padding) -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-4 text-xs text-stone-700 bg-stone-50/70 p-3 rounded-lg border border-stone-200">
        <div>
            <span class="text-[10px] font-bold text-stone-400 uppercase block tracking-wider">Candidate Name</span>
            <span class="font-bold text-stone-800 text-sm">{{Auth::user()->name}}</span>
        </div>
        <div class="md:text-right flex flex-col md:items-end justify-center">
            <span class="text-[10px] font-bold text-stone-400 uppercase block tracking-wider mb-1">Payment Status</span>
            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-amber-800 uppercase tracking-wide border border-amber-200/60">
                <span class="w-1.5 h-1.5 mr-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                Pending
            </span>
        </div>
    </div>

    <!-- New Breakdown Matrix Table Container -->
    <div class="bg-white rounded-xl border border-stone-200 overflow-hidden flex flex-col">
        <div class="bg-darkblue px-6 py-4 flex justify-between items-center">
            <span class="text-xs font-bold text-white uppercase tracking-wider">Breakdown Matrix</span>
            <span class="text-[10px] font-bold text-gold uppercase tracking-wider">Session: 2025/2026</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-xs text-left border-collapse">
                <thead class="bg-stone-100 text-stone-600 font-bold uppercase text-[10px] border-b border-stone-200">
                    <tr>
                        <th class="px-6 py-3 w-16 text-center">S/N</th>
                        <th class="px-6 py-3">Item Description</th>
                        <th class="px-6 py-3 text-right">Amount</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-200 text-stone-700">
                    <tr><td class="px-6 py-3 text-center font-medium text-stone-400">1</td><td class="px-6 py-3">Tuition Charges</td><td class="px-6 py-3 text-right font-semibold">₦45,000.00</td></tr>
                    <tr><td class="px-6 py-3 text-center font-medium text-stone-400">2</td><td class="px-6 py-3">Library Access Fee</td><td class="px-6 py-3 text-right font-semibold">₦3,500.00</td></tr>
                    <tr><td class="px-6 py-3 text-center font-medium text-stone-400">3</td><td class="px-6 py-3">ICT Infrastructure Fee</td><td class="px-6 py-3 text-right font-semibold">₦5,000.00</td></tr>
                    <tr><td class="px-6 py-3 text-center font-medium text-stone-400">4</td><td class="px-6 py-3">Medical Services</td><td class="px-6 py-3 text-right font-semibold">₦2,500.00</td></tr>
                    <tr><td class="px-6 py-3 text-center font-medium text-stone-400">5</td><td class="px-6 py-3">Sports & Games Levy</td><td class="px-6 py-3 text-right font-semibold">₦500.00</td></tr>
                    <tr><td class="px-6 py-3 text-center font-medium text-stone-400">6</td><td class="px-6 py-3">Student ID Card Renewal</td><td class="px-6 py-3 text-right font-semibold">₦763.00</td></tr>
                    <tr><td class="px-6 py-3 text-center font-medium text-stone-400">7</td><td class="px-6 py-3">Laboratory Logbook</td><td class="px-6 py-3 text-right font-semibold">₦1,200.00</td></tr>
                    <tr><td class="px-6 py-3 text-center font-medium text-stone-400">8</td><td class="px-6 py-3">Examination Processing</td><td class="px-6 py-3 text-right font-semibold">₦2,000.00</td></tr>
                    <tr><td class="px-6 py-3 text-center font-medium text-stone-400">9</td><td class="px-6 py-3">Campus Security Levy</td><td class="px-6 py-3 text-right font-semibold">₦1,000.00</td></tr>
                    <tr><td class="px-6 py-3 text-center font-medium text-stone-400">10</td><td class="px-6 py-3">Student Insurance Policy</td><td class="px-6 py-3 text-right font-semibold">₦1,336.65</td></tr>
                </tbody>
                <tfoot class="bg-stone-50 border-t-2 border-stone-200 font-bold text-darkblue">
                    <tr>
                        <td colspan="2" class="px-6 py-4 text-right uppercase tracking-wider text-[10px]">Cumulative Total:</td>
                        <td class="px-6 py-4 text-right text-base font-black text-stone-900">₦59,799.65</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- Action Footer stretched to Full Width -->
        <div class="p-6 bg-stone-50 border-t border-stone-200 w-full">
            <!-- Stretched container taking 100% space -->
            <div id="paypal-button-container" class="w-full"></div>
        </div>
    </div>


{{-- Pay Pal Button For School Fees Payment --}}
<script>
paypal.Buttons({
    style: {
        layout: 'vertical',
        color:  'gold',
        shape:  'rect',
        label:  'paypal',
        height: 40 
    },

    // 1. Set up the transaction details
    createOrder: function(data, actions) {
        return actions.order.create({
            purchase_units: [{
                amount: {
                    value: '59799.65' 
                }
            }]
        });
    },

    // 2. Capture the funds when the user approves the payment in the popup
    onApprove: function(data, actions) {
        return actions.order.capture().then(function(details) {
            const paymentId = data.orderID; 
            const transactionId = details.purchase_units[0].payments.captures[0].id;
            
            alert('Transaction completed by ' + details.payer.name.given_name);
            console.log('PayPal Order ID:', paymentId);
            console.log('Capture/Transaction ID:', transactionId);
        });
    },

    // 3. Handle errors gracefully
    onError: function(err) {
        console.error('PayPal Error:', err);
        alert('Something went wrong with the payment process.');
    }
}).render('#paypal-button-container');
</script>

</div>