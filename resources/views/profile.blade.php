<x-app-layout>

<div class="min-h-screen bg-gray-900 text-gray-200">
    <!-- Profile Header -->
    <div class="bg-gray-800 py-8 mt-16">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row items-center md:items-start gap-6">
                <div class="relative">
                    <img src="https://avatar.iran.liara.run/public/boy" alt="Photo de profil" class="rounded-full h-32 w-32 border-4 border-indigo-500"/>
                    <div class="absolute bottom-0 right-0 bg-green-500 h-5 w-5 rounded-full border-2 border-gray-800"></div>
                </div>
                
                <div class="flex-1">
                    <div class="flex flex-col md:flex-row justify-between">
                        <div>
                            <h1 class="text-3xl font-bold">{{ auth()->user()->username}}</h1>
                            <p class="text-indigo-400">Full Stack Developer</p>
                        </div>
                        
                    </div>
                    
                    <div class="mt-4 flex flex-wrap gap-4">
                        <div class="flex items-center text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            {{ auth()->user()->email}}
                        </div>
                        <div class="flex items-center text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            325 Publications
                        </div>
                        <div class="flex items-center text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            428 Connexions
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="container mx-auto px-6 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Biography -->
                <div class="bg-gray-800 rounded-lg shadow-lg p-6">
                    <h2 class="text-xl font-semibold mb-4">Biographie</h2>
                    <p class="text-gray-300">
                        {{ auth()->user()->biography }}
                    </p>
                </div>
                
                <!-- Skills -->
                <div class="bg-gray-800 rounded-lg shadow-lg p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-semibold">Compétences</h2>
                        <button class="text-indigo-400 hover:text-indigo-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </button>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <span class="bg-indigo-900 text-indigo-300 px-3 py-1 rounded-full text-sm">React</span>
                        <span class="bg-indigo-900 text-indigo-300 px-3 py-1 rounded-full text-sm">Vue.js</span>
                        <span class="bg-indigo-900 text-indigo-300 px-3 py-1 rounded-full text-sm">Laravel</span>
                        <span class="bg-indigo-900 text-indigo-300 px-3 py-1 rounded-full text-sm">Node.js</span>
                        <span class="bg-indigo-900 text-indigo-300 px-3 py-1 rounded-full text-sm">MongoDB</span>
                        <span class="bg-indigo-900 text-indigo-300 px-3 py-1 rounded-full text-sm">MySQL</span>
                        <span class="bg-indigo-900 text-indigo-300 px-3 py-1 rounded-full text-sm">Docker</span>
                        <span class="bg-indigo-900 text-indigo-300 px-3 py-1 rounded-full text-sm">AWS</span>
                        <span class="bg-indigo-900 text-indigo-300 px-3 py-1 rounded-full text-sm">CI/CD</span>
                        <span class="bg-indigo-900 text-indigo-300 px-3 py-1 rounded-full text-sm">TDD</span>
                        <span class="bg-indigo-900 text-indigo-300 px-3 py-1 rounded-full text-sm">REST API</span>
                        <span class="bg-indigo-900 text-indigo-300 px-3 py-1 rounded-full text-sm">GraphQL</span>
                    </div>
                </div>
                
                <!-- Languages -->
                <div class="bg-gray-800 rounded-lg shadow-lg p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-semibold">Langages de programmation</h2>
                        <button class="text-indigo-400 hover:text-indigo-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </button>
                    </div>
                    <div class="space-y-3">
                        <div>
                            <div class="flex justify-between mb-1">
                                <span>JavaScript/TypeScript</span>
                                <span>95%</span>
                            </div>
                            <div class="w-full bg-gray-700 rounded-full h-2">
                                <div class="bg-indigo-500 h-2 rounded-full" style="width: 95%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between mb-1">
                                <span>PHP</span>
                                <span>85%</span>
                            </div>
                            <div class="w-full bg-gray-700 rounded-full h-2">
                                <div class="bg-indigo-500 h-2 rounded-full" style="width: 85%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between mb-1">
                                <span>Python</span>
                                <span>75%</span>
                            </div>
                            <div class="w-full bg-gray-700 rounded-full h-2">
                                <div class="bg-indigo-500 h-2 rounded-full" style="width: 75%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between mb-1">
                                <span>Java</span>
                                <span>60%</span>
                            </div>
                            <div class="w-full bg-gray-700 rounded-full h-2">
                                <div class="bg-indigo-500 h-2 rounded-full" style="width: 60%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between mb-1">
                                <span>Go</span>
                                <span>40%</span>
                            </div>
                            <div class="w-full bg-gray-700 rounded-full h-2">
                                <div class="bg-indigo-500 h-2 rounded-full" style="width: 40%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- GitHub Integration -->
                <div class="bg-gray-800 rounded-lg shadow-lg p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-semibold">GitHub</h2>
                        <a href="https://github.com/sophiedev" target="_blank" class="text-indigo-400 hover:text-indigo-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                            </svg>
                        </a>
                    </div>
                    <div class="flex items-center space-x-4 mb-4">
                        <img src="/api/placeholder/60/60" alt="GitHub Avatar" class="rounded-full h-12 w-12"/>
                        <div>
                            <div class="font-medium">@sophiedev</div>
                            <div class="text-gray-400 text-sm">35 dépôts publics</div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4 text-center">
                        <div class="bg-gray-700 p-3 rounded-lg">
                            <div class="text-lg font-semibold">1.2k</div>
                            <div class="text-gray-400 text-sm">Contributions</div>
                        </div>
                        <div class="bg-gray-700 p-3 rounded-lg">
                            <div class="text-lg font-semibold">184</div>
                            <div class="text-gray-400 text-sm">Followers</div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="font-medium mb-2">Activité récente</div>
                        <div class="bg-gray-700 p-3 rounded-lg mb-2">
                            <div class="font-medium">e-commerce-platform</div>
                            <div class="text-sm text-gray-400">5 commits il y a 2 jours</div>
                        </div>
                        <div class="bg-gray-700 p-3 rounded-lg">
                            <div class="font-medium">react-component-library</div>
                            <div class="text-sm text-gray-400">2 pull requests il y a 5 jours</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Right Column -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Projects -->
                <div class="bg-gray-800 rounded-lg shadow-lg p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold">Projets</h2>
                        <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-1 rounded-md text-sm">
                            Ajouter un projet
                        </button>
                    </div>
                    
                    <div class="space-y-6">
                        <!-- Project 1 -->
                        <div class="border-b border-gray-700 pb-6">
                            <div class="flex justify-between mb-2">
                                <h3 class="font-medium text-lg">E-commerce Platform</h3>
                                <div class="text-gray-400 text-sm">Nov 2023 - Présent</div>
                            </div>
                            <p class="text-gray-300 mb-3">
                                Plateforme e-commerce complète avec panier d'achat, paiements sécurisés et tableau de bord administrateur.
                                Développée avec Laravel, Vue.js et MySQL.
                            </p>
                            <div class="flex flex-wrap gap-2 mb-3">
                                <span class="bg-indigo-900 text-indigo-300 px-2 py-1 rounded-md text-xs">Laravel</span>
                                <span class="bg-indigo-900 text-indigo-300 px-2 py-1 rounded-md text-xs">Vue.js</span>
                                <span class="bg-indigo-900 text-indigo-300 px-2 py-1 rounded-md text-xs">MySQL</span>
                                <span class="bg-indigo-900 text-indigo-300 px-2 py-1 rounded-md text-xs">Stripe API</span>
                            </div>
                            <div class="flex space-x-3">
                                <a href="#" class="text-indigo-400 hover:text-indigo-300 text-sm">Démo</a>
                                <a href="#" class="text-indigo-400 hover:text-indigo-300 text-sm">GitHub</a>
                            </div>
                        </div>
                        
                        <!-- Project 2 -->
                        <div class="border-b border-gray-700 pb-6">
                            <div class="flex justify-between mb-2">
                                <h3 class="font-medium text-lg">React Component Library</h3>
                                <div class="text-gray-400 text-sm">Juin 2023 - Oct 2023</div>
                            </div>
                            <p class="text-gray-300 mb-3">
                                Bibliothèque de composants React réutilisables et accessibles, avec documentation complète et exemples.
                                Publiée sur npm avec plus de 2000 téléchargements.
                            </p>
                            <div class="flex flex-wrap gap-2 mb-3">
                                <span class="bg-indigo-900 text-indigo-300 px-2 py-1 rounded-md text-xs">React</span>
                                <span class="bg-indigo-900 text-indigo-300 px-2 py-1 rounded-md text-xs">TypeScript</span>
                                <span class="bg-indigo-900 text-indigo-300 px-2 py-1 rounded-md text-xs">Storybook</span>
                                <span class="bg-indigo-900 text-indigo-300 px-2 py-1 rounded-md text-xs">Jest</span>
                            </div>
                            <div class="flex space-x-3">
                                <a href="#" class="text-indigo-400 hover:text-indigo-300 text-sm">Documentation</a>
                                <a href="#" class="text-indigo-400 hover:text-indigo-300 text-sm">GitHub</a>
                                <a href="#" class="text-indigo-400 hover:text-indigo-300 text-sm">npm</a>
                            </div>
                        </div>
                        
                        <!-- Project 3 -->
                        <div>
                            <div class="flex justify-between mb-2">
                                <h3 class="font-medium text-lg">AI-powered Task Manager</h3>
                                <div class="text-gray-400 text-sm">Jan 2023 - Mai 2023</div>
                            </div>
                            <p class="text-gray-300 mb-3">
                                Application de gestion de tâches avec fonctionnalités d'IA pour la priorisation et les suggestions.
                                Utilise Node.js, MongoDB et intégration avec OpenAI API.
                            </p>
                            <div class="flex flex-wrap gap-2 mb-3">
                                <span class="bg-indigo-900 text-indigo-300 px-2 py-1 rounded-md text-xs">Node.js</span>
                                <span class="bg-indigo-900 text-indigo-300 px-2 py-1 rounded-md text-xs">Express</span>
                                <span class="bg-indigo-900 text-indigo-300 px-2 py-1 rounded-md text-xs">MongoDB</span>
                                <span class="bg-indigo-900 text-indigo-300 px-2 py-1 rounded-md text-xs">OpenAI API</span>
                            </div>
                            <div class="flex space-x-3">
                                <a href="#" class="text-indigo-400 hover:text-indigo-300 text-sm">Démo</a>
                                <a href="#" class="text-indigo-400 hover:text-indigo-300 text-sm">GitHub</a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Certifications -->
                <div class="bg-gray-800 rounded-lg shadow-lg p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold">Certifications</h2>
                        <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-1 rounded-md text-sm">
                            Ajouter une certification
                        </button>
                    </div>
                    
                    <div class="space-y-4">
                        <!-- Certification 1 -->
                        <div class="flex items-start gap-4 border-b border-gray-700 pb-4">
                            <img src="/api/placeholder/60/60" alt="AWS" class="w-12 h-12 rounded"/>
                            <div class="flex-1">
                                <div class="flex justify-between">
                                    <h3 class="font-medium">AWS Certified Solutions Architect</h3>
                                    <div class="text-indigo-400">Vérifiée</div>
                                </div>
                                <div class="text-gray-400 mb-2">Amazon Web Services</div>
                                <div class="text-sm text-gray-400">Délivré en décembre 2023 · Expire en décembre 2026</div>
                            </div>
                        </div>
                        
                        <!-- Certification 2 -->
                        <div class="flex items-start gap-4 border-b border-gray-700 pb-4">
                            <img src="/api/placeholder/60/60" alt="Google" class="w-12 h-12 rounded"/>
                            <div class="flex-1">
                                <div class="flex justify-between">
                                    <h3 class="font-medium">Google Professional Cloud Developer</h3>
                                    <div class="text-indigo-400">Vérifiée</div>
                                </div>
                                <div class="text-gray-400 mb-2">Google Cloud</div>
                                <div class="text-sm text-gray-400">Délivré en août 2023 · Expire en août 2025</div>
                            </div>
                        </div>
                        
                        <!-- Certification 3 -->
                        <div class="flex items-start gap-4">
                            <img src="/api/placeholder/60/60" alt="React" class="w-12 h-12 rounded"/>
                            <div class="flex-1">
                                <div class="flex justify-between">
                                    <h3 class="font-medium">Advanced React & Redux</h3>
                                    <div class="text-indigo-400">Vérifiée</div>
                                </div>
                                <div class="text-gray-400 mb-2">Udemy</div>
                                <div class="text-sm text-gray-400">Délivré en mars 2023</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-4 text-center">
                        <button class="text-indigo-400 hover:text-indigo-300 text-sm">
                            Voir toutes les certifications (8)
                        </button>
                    </div>
                </div>
                
                <!-- Activity Feed -->
                <div class="bg-gray-800 rounded-lg shadow-lg p-6">
                    <h2 class="text-xl font-semibold mb-6">Activité récente</h2>
                    
                    <div class="space-y-6">
                        <div class="flex gap-4">
                            <img src="/api/placeholder/40/40" alt="Photo de profil" class="rounded-full h-10 w-10"/>
                            <div class="flex-1">
                                <div class="font-medium">Sophie Dupont a partagé un article</div>
                                <div class="text-gray-400 text-sm mb-2">Il y a 2 jours</div>
                                <div class="bg-gray-700 p-4 rounded-lg">
                                    <h3 class="font-medium mb-2">Comment optimiser les performances de vos applications React</h3>
                                    <p class="text-gray-300 text-sm mb-2">
                                        Dans cet article, je partage mes conseils pour améliorer les performances des applications React, 
                                        y compris l'utilisation de React.memo, useCallback et plus encore...
                                    </p>
                                    <div class="flex space-x-4 text-sm text-indigo-400">
                                        <button>Lire l'article</button>
                                        <span>47 likes</span>
                                        <span>12 commentaires</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex gap-4">
                            <img src="/api/placeholder/40/40" alt="Photo de profil" class="rounded-full h-10 w-10"/>
                            <div class="flex-1">
                                <div class="font-medium">Sophie Dupont a ajouté un nouveau projet</div>
                                <div class="text-gray-400 text-sm">Il y a 1 semaine</div>
                            </div>
                        </div>
                        
                        <div class="flex gap-4">
                            <img src="/api/placeholder/40/40" alt="Photo de profil" class="rounded-full h-10 w-10"/>
                            <div class="flex-1">
                                <div class="font-medium">Sophie Dupont a obtenu une nouvelle certification</div>
                                <div class="text-gray-400 text-sm mb-2">Il y a 2 semaines</div>
                                <div class="bg-gray-700 p-4 rounded-lg">
                                    <div class="flex items-center gap-3">
                                        <img src="/api/placeholder/40/40" alt="AWS" class="w-10 h-10 rounded"/>
                                        <div>
                                            <div class="font-medium">AWS Certified Solutions Architect</div>
                                            <div class="text-gray-400 text-sm">Amazon Web Services</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-6 text-center">
                        <button class="text-indigo-400 hover:text-indigo-300">
                            Voir plus d'activités
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</x-app-layout>