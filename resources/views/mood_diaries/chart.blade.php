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
        // 获取图表数据
        fetch("{{ url('/mood-diaries/chart-data') }}")
            .then(response => response.json())
            .then(data => {
                const ctx = document.getElementById('moodChart').getContext('2d');

                // 创建折线图
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: data.dates, // X轴：日期
                        datasets: [{
                            label: 'Mood Trends',
                            data: data.moods, // Y轴：Mood
                            borderColor: 'rgba(75, 192, 192, 1)',
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderWidth: 2,
                            tension: 0.4, // 平滑曲线
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
