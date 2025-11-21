<?php include __DIR__.'/../layout_head.php'; ?>

<?php
// Helper untuk Sidebar (bisa dipisah jadi partial view nanti jika mau lebih DRY)
$user = $_SESSION['user'];
$role = $user['role'];

// Hitung Statistik Sederhana untuk Admin
$totalPending = 0;
$totalHeld = 0;
foreach($bookings as $b) { if($b['status'] == 'PAID') $totalPending++; }
foreach($escrows as $e) { if($e['status'] == 'HELD') $totalHeld += $e['amount']; }
?>

<div class="min-h-screen bg-gray-50 flex pt-4 pb-10 px-4 md:px-8 gap-8">
    
    <div class="w-full md:w-72 flex-shrink-0 hidden md:block">
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 sticky top-24">
            
            <div class="flex items-center gap-4 mb-8 pb-8 border-b border-gray-100">
                <img src="https://ui-avatars.com/api/?name=<?= urlencode($user['name']) ?>&background=111827&color=fff" class="w-12 h-12 rounded-full">
                <div>
                    <h4 class="font-bold text-gray-900 text-sm"><?= htmlspecialchars($user['name']) ?></h4>
                    <p class="text-xs text-gray-500 capitalize">Super Admin</p>
                </div>
            </div>

            <nav class="space-y-2">
                <a href="/profile" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-gray-900 rounded-xl font-medium text-sm transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    Personal Data
                </a>
                
                <a href="/admin/dashboard" class="flex items-center gap-3 px-4 py-3 bg-blue-50 text-blue-600 rounded-xl font-bold text-sm transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    Transactions & Payouts
                </a>

                <div class="pt-4 mt-4 border-t border-gray-100">
                    <a href="/logout" class="flex items-center gap-3 px-4 py-3 text-red-500 hover:bg-red-50 rounded-xl font-bold text-sm transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        Log out
                    </a>
                </div>
            </nav>
        </div>
    </div>

    <div class="flex-1 w-full">
        
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900 mb-6">Admin Dashboard</h1>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm flex items-center gap-4">
                    <div class="w-12 h-12 bg-yellow-100 text-yellow-600 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase font-bold">Pending Verification</p>
                        <p class="text-2xl font-bold text-gray-900"><?= $totalPending ?></p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm flex items-center gap-4">
                    <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase font-bold">Escrow Balance</p>
                        <p class="text-2xl font-bold text-gray-900">Rp <?= number_format($totalHeld) ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden mb-8">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-lg font-bold text-gray-900">1. Incoming Payments</h3>
                <span class="text-xs bg-gray-100 text-gray-600 px-3 py-1 rounded-full font-bold">Needs Approval</span>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 text-xs font-bold text-gray-500 uppercase tracking-wider">
                            <th class="p-4">Guest</th>
                            <th class="p-4">Hotel & Room</th>
                            <th class="p-4">Total Amount</th>
                            <th class="p-4">Proof</th>
                            <th class="p-4 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php $hasPending = false; ?>
                        <?php foreach($bookings as $b): ?>
                            <?php if($b['status'] == 'PAID'): $hasPending = true; ?>
                            <tr class="hover:bg-gray-50 transition">
                                <td class="p-4 font-medium text-gray-900"><?= htmlspecialchars($b['user_name']) ?></td>
                                <td class="p-4 text-sm text-gray-500"><?= htmlspecialchars($b['hotel_name']) ?></td>
                                <td class="p-4 font-bold text-gray-900">Rp <?= number_format($b['total_price']) ?></td>
                                <td class="p-4">
                                    <a href="/<?= htmlspecialchars($b['payment_proof']) ?>" target="_blank" class="text-blue-600 hover:underline text-sm font-bold flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                        View
                                    </a>
                                </td>
                                <td class="p-4 text-right">
                                    <a href="/admin/confirm?id=<?= $b['id'] ?>" class="bg-green-100 text-green-700 px-4 py-2 rounded-xl text-sm font-bold hover:bg-green-200 transition inline-flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        Approve
                                    </a>
                                </td>
                            </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>

                        <?php if(!$hasPending): ?>
                        <tr>
                            <td colspan="5" class="p-8 text-center text-gray-400 text-sm">
                                No pending payments to verify.
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-lg font-bold text-gray-900">2. Escrow Payouts (Release Funds)</h3>
                <span class="text-xs bg-blue-50 text-blue-600 px-3 py-1 rounded-full font-bold">Safe Balance</span>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 text-xs font-bold text-gray-500 uppercase tracking-wider">
                            <th class="p-4">Hotel Owner</th>
                            <th class="p-4">Booking ID</th>
                            <th class="p-4">Amount</th>
                            <th class="p-4">Status</th>
                            <th class="p-4 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php foreach($escrows as $e): ?>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="p-4 font-medium text-gray-900"><?= htmlspecialchars($e['owner_name']) ?></td>
                            <td class="p-4 text-sm text-gray-500">#TRV-<?= $e['booking_ref'] ?></td>
                            <td class="p-4 font-bold text-gray-900">Rp <?= number_format($e['amount']) ?></td>
                            <td class="p-4">
                                <?php if($e['status'] == 'HELD'): ?>
                                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold">HELD (Safe)</span>
                                <?php else: ?>
                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">RELEASED</span>
                                <?php endif; ?>
                            </td>
                            <td class="p-4 text-right">
                                <?php if($e['status'] == 'HELD'): ?>
                                    <a href="/admin/release?id=<?= $e['id'] ?>" onclick="return confirm('Are you sure you want to release funds to Owner?')" class="bg-blue-600 text-white px-4 py-2 rounded-xl text-sm font-bold hover:bg-blue-700 transition inline-flex items-center gap-2 shadow-lg shadow-blue-200">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        Release Funds
                                    </a>
                                <?php else: ?>
                                    <span class="text-xs text-gray-400 font-bold flex items-center justify-end gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        Completed
                                    </span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        
                        <?php if(empty($escrows)): ?>
                        <tr><td colspan="5" class="p-8 text-center text-gray-400 text-sm">No transaction history yet.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<?php include __DIR__.'/../layout_foot.php'; ?>