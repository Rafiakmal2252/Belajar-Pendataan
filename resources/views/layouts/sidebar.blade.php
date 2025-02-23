<aside id="logo-sidebar"
        class="fixed top-0 left-0 z-40 w-48 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
        aria-label="Sidebar">
        <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="{{ route('dashboard.index') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <span class="material-icons">dashboard</span>
                        <p class="ms-3">Dashboard</p>
                    </a>
                </li>
                <li>
                    <a href="{{ route('member.index') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <span class="material-icons">group</span>
                        <p class="ms-3">Data Anggota</p>
                    </a>
                </li>
                <li>
                    <a href="{{ route('learn.index') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <span class="material-icons">menu_book</span>
                        <p class="ms-3">Kajian Ringkas</p>
                    </a>
                </li>
                <li>
                    <a href="{{ route('discussion.index') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <span class="material-icons">forum</span>
                        <p class="ms-3">Diskusi</p>
                    </a>
                </li>
                @if (auth()->user()->role == 'ADMIN')
                <li>
                    <a href="{{ route('invitation.index') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <span class="material-icons">vpn_key</span>
                        <p class="ms-3 text-nowrap">Kode Undangan</p>
                    </a>
                </li>
                @endif
            </ul>
        </div>
    </aside>

