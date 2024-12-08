@extends('layouts.app')

@section('title', 'Mood Trend Chart')

@section('content')
    <div class="container">
        <h2 class="mb-4">Mood Record Trends</h2>
        <canvas id="moodChart" width="400" height="200"></canvas>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/chart.js') }}"></script>
    <script>

        fetch("{{ url('/mood-diaries/chart-data') }}")
            .then(response => response.json())
            .then(data => {
                const ctx = document.getElementById('moodChart').getContext('2d');

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: data.dates, 
                        datasets: [{
                            label: 'Mood Trends',
                            data: data.moods, 
                            borderColor: 'rgba(75, 192, 192, 1)',
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderWidth: 2,
                            tension: 0.4, 
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top',
                            }
                        },
                        scales: {
                            x: {
                                title: {
                                    display: true,
                                    text: 'Date',
                                }
                            },
                            y: {
                                title: {
                                    display: true,
                                    text: 'Mood Value',
                                },
                                beginAtZero: true,
                            }
                        }
                    }
                });
            })
            .catch(error => console.error('Error fetching chart data:', error));
    </script>
@endsection
