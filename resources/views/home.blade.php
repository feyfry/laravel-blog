@extends('layouts.app')

@push('css')
<style>
:root {
    --primary-color: #FFB6C1;
    --secondary-color: #B0E0E6;
    --background-color: #F9F9F9;
}

.card {
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    position: relative;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    margin-bottom: 20px;
}

.card::before {
    content: '';
    position: absolute;
    top: -30px;
    left: 0;
    right: 0;
    height: 60px;
    border-radius: 50%;
    transform: scaleX(1.5);
}

.card:hover {
    transform: translateY(-5px) rotate(1deg);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
}

.card-title {
    /* color: #fff; */
    font-size: 1.2rem;
    font-weight: bold;
    position: relative;
    z-index: 1;
}

.display-4 {
    font-size: 2.5rem;
    font-weight: bold;
    color: #fff;
}

.chart-container {
    height: 300px;
    margin-top: 20px;
    background-color: #fff;
    border-radius: 10px;
    padding: 15px;
}

.table {
    margin-bottom: 0;
}

.badge {
    padding: 0.5em 1em;
    border-radius: 20px;
}
</style>
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h2 class="mb-4">{{ __('Dashboard') }}</h2>

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Statistik Cards -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total Articles</h5>
                            <div class="display-4">{{ $data['totalArticles'] }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Draft Articles</h5>
                            <div class="display-4">{{ $data['draftArticles'] }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Published Articles</h5>
                            <div class="display-4">{{ $data['publishedArticles'] }}</div>
                        </div>
                    </div>
                </div>
                @if(Auth::user()->hasRole('owner'))
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total Writers</h5>
                            <div class="display-4">{{ $data['totalWriters'] }}</div>
                        </div>
                    </div>
                </div>
                @endif
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Confirmed Articles</h5>
                            <div class="display-4">{{ $data['confirmedArticles'] }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Unconfirmed Articles</h5>
                            <div class="display-4">{{ $data['unConfirmedArticles'] }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts -->
            <div class="row mb-4">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Daily Article Creation</h5>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="dailyArticleChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Article Status Distribution</h5>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="articleStatusChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Category Statistics & Recent Articles -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Articles by Category</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Category</th>
                                            <th>Total Articles</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data['categoryStats'] as $category)
                                        <tr>
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->articles_count }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Recent Articles</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data['recentArticles'] as $article)
                                        <tr>
                                            <td>{{ $article->title }}</td>
                                            <td>{{ $article->category->name }}</td>
                                            <td>
                                                @if($article->published)
                                                    <span class="badge bg-success">Published</span>
                                                @else
                                                    <span class="badge bg-secondary">Draft</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.6/dist/chart.umd.min.js"></script>
<script>
    // Daily Article Creation Chart
    let dailyCtx = document.getElementById('dailyArticleChart').getContext('2d');
    let dailyChart = new Chart(dailyCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($data['chartLabels']) !!}.map(date => {
                return new Date(date).toLocaleDateString('en-US', {
                    month: 'short',
                    day: 'numeric'
                });
            }),
            datasets: [{
                label: 'Articles Created',
                data: {!! json_encode($data['chartData']) !!},
                borderColor: '#4e73df',
                backgroundColor: 'rgba(78, 115, 223, 0.05)',
                borderWidth: 2,
                tension: 0.1,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            }
        }
    });

    // Article Status Distribution Chart
    let statusCtx = document.getElementById('articleStatusChart').getContext('2d');
    let statusChart = new Chart(statusCtx, {
        type: 'doughnut',
        data: {
            labels: ['Draft Articles', 'Published Articles', 'Confirmed Articles', 'Unconfirmed Articles'],
            datasets: [{
                data: [
                    {{ $data['draftArticles'] }},
                    {{ $data['publishedArticles'] }},
                    {{ $data['confirmedArticles'] }},
                    {{ $data['unConfirmedArticles'] }}
                ],
                backgroundColor: ['#FFA500', '#32CD32', '#4e73df', '#e74a3b'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            },
            cutout: '70%'
        }
    });
</script>
@endpush
