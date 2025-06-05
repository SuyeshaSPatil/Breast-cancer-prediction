@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-r from-pink-100 to-white">

    <!-- Welcome Section -->
    <div class="text-center py-20">
        <h1 class="text-5xl font-bold text-pink-800 mb-6 animate__animated animate__fadeIn">Welcome to Breast Cancer Detection Portal 🎗️</h1>
        <p class="text-xl text-pink-600 mb-4">Empowering early detection through AI and Machine Learning</p>
        <p class="text-md text-gray-600 mb-8">Track patient statistics, reports, and insights with real-time Power BI dashboards.</p>
        <a href="{{ route('login') }}" class="px-6 py-3 bg-pink-600 text-white rounded-lg hover:bg-pink-700 transition-all">Go to Dashboard</a>
    </div>

    <!-- Power BI Dashboard Embed Section -->
    <div class="max-w-6xl mx-auto px-4 py-16 bg-white rounded-xl shadow-xl">
        <h2 class="text-3xl font-semibold text-center text-pink-700 mb-8">Patient Report Visualization</h2>
        <div class="aspect-w-16 aspect-h-9">
            <iframe 
                width="100%" 
                height="600" 
                src="https://app.powerbi.com/view?r=YOUR_EMBED_URL_HERE" 
                frameborder="0" 
                allowFullScreen="true"
                class="rounded-lg shadow-lg">
            </iframe>
        </div>
        <p class="text-sm text-center text-gray-500 mt-4">* This dashboard shows AI-analyzed data from patient records and performance.</p>
    </div>

    <!-- Key Features Section -->
    <div class="py-16 bg-pink-50">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-semibold text-pink-700">Project Highlights</h2>
            <p class="text-lg text-gray-600">A quick glance at what our system offers</p>
        </div>
        <div class="flex flex-wrap justify-center gap-8">
            <div class="w-72 bg-white rounded-lg shadow-md p-6 text-center">
                <h3 class="text-xl font-bold text-pink-600 mb-2">AI-Based Predictions</h3>
                <p class="text-gray-600">Leverages machine learning algorithms for early cancer detection with high accuracy.</p>
            </div>
            <div class="w-72 bg-white rounded-lg shadow-md p-6 text-center">
                <h3 class="text-xl font-bold text-pink-600 mb-2">Live Analytics</h3>
                <p class="text-gray-600">Real-time updates and visualizations powered by Power BI.</p>
            </div>
            <div class="w-72 bg-white rounded-lg shadow-md p-6 text-center">
                <h3 class="text-xl font-bold text-pink-600 mb-2">Patient Records</h3>
                <p class="text-gray-600">Secure and interactive access to patients' diagnostic reports and trends.</p>
            </div>
        </div>
    </div>

    <!-- Testimonials Section -->
    <div class="py-16 bg-white">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-semibold text-pink-700">What Doctors Say</h2>
            <p class="text-lg text-gray-600">Trusted by healthcare professionals and researchers</p>
        </div>
        <div class="flex justify-center gap-10">
            <div class="w-96 bg-pink-100 p-6 rounded-lg shadow-md">
                <p class="text-gray-700">"This system is a game-changer. Early detection and report visualization are extremely effective!"</p>
                <p class="text-pink-700 mt-4 font-semibold">– Dr. Sneha Patil</p>
            </div>
            <div class="w-96 bg-pink-100 p-6 rounded-lg shadow-md">
                <p class="text-gray-700">"We’re able to monitor patients better and deliver timely interventions."</p>
                <p class="text-pink-700 mt-4 font-semibold">– Dr. Ramesh Pawar</p>
            </div>
        </div>
    </div>

</div>
@endsection
