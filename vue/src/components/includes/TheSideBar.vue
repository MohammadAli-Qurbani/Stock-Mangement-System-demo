<template>
    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <router-link active-class="active-link" exact-active-class="exact-active-link"  :to="{name:'home'}" class="nav-link " >
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </router-link>
            </li><!-- End Dashboard Nav -->



            <li class="nav-item">
                <router-link active-class="active-link" exact-active-class="exact-active-link"  :to="{ name: 'supplier' }" class="nav-link collapsed">
                    <i class="bi bi-person"></i>
                    <span>supplier</span>
                </router-link>
            </li><!-- End Profile Page Nav -->

            <li class="nav-item">
                <router-link active-class="active-link" exact-active-class="exact-active-link"  :to="{ name: 'category' }" class="nav-link collapsed">
                    <i class="bi bi-person"></i>
                    <span>category</span>
                </router-link>
            </li><!-- End Profile Page Nav -->


            <li class="nav-item">
                <router-link :to="{ name: 'good' }" class="nav-link collapsed">
                    <i class="bi bi-person"></i>
                    <span>goods</span>
                </router-link>
            </li><!-- End Profile Page Nav -->



            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>good reporst</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <router-link :to="{ name: 'goodTableReport' }" class="nav-link collapsed">
                            <i class="bi bi-person"></i>
                            <span>Table Report</span>
                        </router-link>
                    </li>
                    <li>
                        <router-link :to="{ name: 'goodChartReport' }" class="nav-link collapsed">
                            <i class="bi bi-person"></i>
                            <span>Chart Report</span>
                        </router-link>
                    </li>
                </ul>
            </li><!-- End Components Nav -->
            <li class="nav-item">
                <router-link :to="{ name: 'stock' }" class="nav-link collapsed">
                    <i class="bi bi-person"></i>
                    <span>stock</span>
                </router-link>
            </li><!-- End Profile Page Nav -->


            <li class="nav-item">
                <router-link :to="{ name: 'sell' }" class="nav-link collapsed">
                    <i class="bi bi-person"></i>
                    <span>sell</span>
                </router-link>
            </li><!-- End Profile Page Nav -->


            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-journal-text"></i><span>Sell Reports</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                    <li>
                        <router-link :to="{ name: 'sellMonthlyReport' }" class="nav-link collapsed">
                            <i class="bi bi-circle"></i><span>Monthly chart report</span>
                        </router-link>
                    </li><!-- End Profile Page Nav -->


            </li>
            <li>
                <router-link :to="{ name: 'SellYearlyReport' }" class="nav-link collapsed">
                    <i class="bi bi-circle"></i><span>year chart report</span>
                </router-link>
            </li><!-- End Profile Page Nav -->
            <li>
                <router-link :to="{ name: 'SellTableReport' }" class="nav-link collapsed">
                    <i class="bi bi-circle"></i><span>Table Report</span>
                </router-link>
            </li>
        </ul>
        </li><!-- End Forms Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-layout-text-window-reverse"></i><span>Expirations</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <router-link :to="{ name: 'UpCommingExpiration' }">

                        <i class="bi bi-circle"></i><span>Up coming expiration</span>
                    </router-link>
                </li>
                <li>
                    <router-link :to="{ name: 'stockExpired' }">

                        <i class="bi bi-circle"></i><span>Good Expired in stock</span>
                    </router-link>
                </li>
            </ul>
        </li><!-- End Tables Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-bar-chart"></i><span>Incomes</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="charts-chartjs.html">
                        <i class="bi bi-circle"></i><span>Daily</span>
                    </a>
                </li>
                <li>
                    <router-link :to="{ name: 'monthlyIncome' }">

                        <i class="bi bi-circle"></i><span>Monthly</span>
                    </router-link>
                </li>
                <li>
                    <router-link :to="{ name: 'yearlyIncome' }">

                        <i class="bi bi-circle"></i><span>Yearly</span>
                    </router-link>
                </li>
            </ul>
        </li><!-- End Charts Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-gem"></i><span>return</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <router-link :to="{ name: 'return' }">

                        <i class="bi bi-circle"></i><span>return back </span>
                    </router-link>
                </li>
                <li>
                    <router-link :to="{ name: 'returneds' }">

                        <i class="bi bi-circle"></i><span>returned gooods</span>
                    </router-link>
                </li>
            </ul>
        </li><!-- End Icons Nav -->


        </ul>

    </aside><!-- End Sidebar-->

</template>
