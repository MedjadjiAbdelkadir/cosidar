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
                        <span class="right-nav-text h4">---- Production ----</span>
                    </li>
                    <li>
                        <a href="{{ route('dashboard.proprietaires.index') }}">
                            <i class="fa fa-users" aria-hidden="true"></i>
                            <span class="right-nav-text">Proprietaires</span>
                        </a>
                    </li>
                    @if (auth()->user()->role == 'admin_direction' || auth()->user()->role == 'admin_sous_direction')
                    <li>
                        <a href="{{ route('dashboard.users.index') }}">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <span class="right-nav-text">Utilisateurs</span>
                        </a>
                    </li>
                    @endif
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
                        <a href="{{ route('dashboard.locaux.index') }}">
                            <i class="fa fa-archive" aria-hidden="true"></i>
                            <span class="right-nav-text">Locaux</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard.actes.index') }}">
                            <i class="ti-comments"></i>
                            <span class="right-nav-text">Réference Actes</span>
                        </a>
                    </li>
                    <li>
                        <span class="right-nav-text h4">---- Inventaire ----</span>
                    </li>
                    <li>
                        <a href="{{ route('dashboard.inventaires.index') }}">
                            <i class="ti-comments"></i>
                            <span class="right-nav-text">Inventaires</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard.fournisseurs.index') }}">
                            <i class="fa fa-users" aria-hidden="true"></i>
                            <span class="right-nav-text">Fournisseurs</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard.articles.index') }}">
                            <i class="ti-comments"></i>
                            <span class="right-nav-text">Articles</span>
                        </a>
                    </li>

                    <li>
                        <span class="right-nav-text h4">--- Consultation ---</span>
                    </li>
                    
                    <li>
                        <a href="{{ route('dashboard.ilots.details') }}">
                            <i class="ti-comments"></i>
                            <span class="right-nav-text">Identification Détaillées</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard.etats.index') }}">
                            <i class="ti-comments"></i>
                            <span class="right-nav-text">Etat Inventaire</span>
                        </a>
                    </li>


                    <li>
                        <a href="{{ route('dashboard.ilots.activityUsers') }}">
                            <i class="fa fa-area-chart" aria-hidden="true"></i>
                            <span class="right-nav-text">Bilan du Production</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard.evaluations.index') }}">
                            <i class="ti-comments"></i>
                            <span class="right-nav-text">Evaluation des Biens</span>
                        </a>
                    </li>
                    <li>
                        <a href="chat-page.html">
                            <i class="fa fa-cog" aria-hidden="true"></i>
                            <span class="right-nav-text">Consultation M à J</span>
                        </a>
                    </li>
                    <li>
                        <span class="right-nav-text h4">--- Mise à Jour ---</span>
                    </li>
                    <li>
                        <a href="chat-page.html">
                            <i class="ti-comments"></i>
                            <span class="right-nav-text">Mutation Globale</span>
                            {{-- <span class="right-nav-text">Acquisition/Echange/Donation</span> --}}
                            

                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Left Sidebar End-->

        <!--=================================
