<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 welcome">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
                            <h1 class="text-4xl">Families</h1>
                        </div>
                        <div class="welcome__info flex flex-col sm:flex-row items-center space-y-4 sm:space-y-0 sm:space-x-4">
                            <img src="/famillie.jpg" alt="Family" class="h-40 w-40 rounded-xl shadow-lg">
                            <p class="text-lg">
                                The following map shows the language families of Europe (distinguished by colour) and languages within those families. Note that the terms “language” and “dialect” are not mutually exclusive, and some of the languages shown in the map may be considered dialects of others.
                            </p>
                        </div>
                        <div class="welcome__button mt-4">
                            <a class="btn-primary" href="{{ route('people.index') }}">Create family</a>
                        </div>
                        <h1 class="text-2xl font-bold mb-6 py-10">Geslachtsverdeling</h1>
                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                        <div class="flex flex-col md:flex-row">
                            <div class="w-full md:w-1/2 p-2">
                                <canvas id="genderChart"></canvas>
                            </div>
                            <div class="w-full md:w-1/2 p-2">
                                <canvas id="childrenChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>



                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        // Geslachtsverdeling
                        const genderData = {
                            male: <?php echo json_encode($genderCount->get('M', 0)); ?>,
                            female: <?php echo json_encode($genderCount->get('F', 0)); ?>,
                        };

                        const ctxGender = document.getElementById('genderChart').getContext('2d');
                        const genderChart = new Chart(ctxGender, {
                            type: 'pie',
                            data: {
                                labels: ['Man', 'Vrouw', 'Onbekend'],
                                datasets: [{
                                    label: 'Geslachtsverdeling',
                                    data: [genderData.male, genderData.female, genderData.unknown],
                                    backgroundColor: ['#36A2EB', '#FF6384', '#FFCE56'],
                                    hoverBackgroundColor: ['#36A2EB', '#FF6384', '#FFCE56']
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false
                            }
                        });

                        // Verdeling van mensen met en zonder kinderen
                        const childrenData = {
                            withChildren: <?php echo json_encode($peopleWithChildren) ?>,
                            withoutChildren: <?php echo json_encode($peopleWithoutChildren) ?>
                        };

                        const ctxChildren = document.getElementById('childrenChart').getContext('2d');
                        const childrenChart = new Chart(ctxChildren, {
                            type: 'bar',
                            data: {
                                labels: ['Met kinderen', 'Zonder kinderen'],
                                datasets: [{
                                    label: 'Verdeling van mensen met en zonder kinderen',
                                    data: [childrenData.withChildren, childrenData.withoutChildren],
                                    backgroundColor: ['#36A2EB', '#FF6384'],
                                    hoverBackgroundColor: ['#36A2EB', '#FF6384']
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false
                            }
                        });
                    });
                </script>
            </div>
        </div>
    </div>

</x-app-layout>