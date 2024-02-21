<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-bg">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- menu title -->
                    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">Dashboard</li>
                    <li>
                        <a href="{{ route('dashboard') }}">
                            <i class="fa fa-tachometer" aria-hidden="true"></i>
                            <span class="right-nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard.users.index') }}">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <span class="right-nav-text">Utilisateurs</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard.ilots.index') }}">
                            <i class="ti-comments"></i>
                            <span class="right-nav-text">Ilots</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard.batiments.index') }}">
                            {{-- <i class="ti-building"></i> --}}
                            <i class="fa fa-building" aria-hidden="true"></i>
                            <span class="right-nav-text">Batiments</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard.inventaires.index') }}">
                            <i class="ti-comments"></i>
                            <span class="right-nav-text">Inventaire</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard.locaux.index') }}">
                            <i class="fa fa-archive" aria-hidden="true"></i>
                            <span class="right-nav-text">Locaux</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard.proprietaires.index') }}">
                            <i class="fa fa-users" aria-hidden="true"></i>
                            <span class="right-nav-text">Proprietaires</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard.actes.index') }}">
                            <i class="ti-comments"></i>
                            <span class="right-nav-text">Réference acte</span>
                        </a>
                    </li>
                    <li>
                        <a href="chat-page.html">
                            <i class="ti-comments"></i>
                            <span class="right-nav-text">Identification détaillée</span>
                        </a>
                    </li>
                    <li>
                        <a href="chat-page.html">
                            <i class="fa fa-cog" aria-hidden="true"></i>
                            <span class="right-nav-text">Settings</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard.ilots.activityUsers') }}">
                            <i class="fa fa-area-chart" aria-hidden="true"></i>
                            <span class="right-nav-text">Bilan</span>
                        </a>
                    </li>
                    <li>
                        <a href="chat-page.html">
                            <i class="ti-comments"></i>
                            <span class="right-nav-text">Mise a jour des Biens</span>
                        </a>
                    </li>
                    <li>
                        <a href="chat-page.html">
                            <i class="ti-comments"></i>
                            <span class="right-nav-text">Acquisition/Echange/Donation</span>
                        </a>
                    </li>
                    <li>
                        <a href="chat-page.html">
                            <i class="ti-comments"></i>
                            <span class="right-nav-text">Mutation Partielle</span>
                        </a>
                    </li>
                    <li>
                        <a href="chat-page.html">
                            <i class="ti-comments"></i>
                            <span class="right-nav-text">Article</span>
                        </a>
                    </li>
                    <li>
                        <a href="chat-page.html">
                            <i class="fa fa-users" aria-hidden="true"></i>
                            <span class="right-nav-text">Fournisseur</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Left Sidebar End-->

        <!--=================================
