@extends('layout') <!-- Zakładamy, że używasz głównego layoutu aplikacji -->
  
@include('components.header_login')

<div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold text-gray-800">Witaj, {{ auth()->user()->first_name }}!</h1>

    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Sekcja z danymi użytkownika -->
        <div class="bg-white p-4 rounded-lg shadow-md">
            <h2 class="text-lg font-semibold text-gray-700">Dane użytkownika</h2>
            <div class="mt-4">
                <p><strong>Imię:</strong> {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</p>
                <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
                <p><strong>Telefon:</strong> {{ auth()->user()->phone }}</p>
                <p><strong>Gatunek muzyczny:</strong> {{ auth()->user()->music_genre }}</p>
            </div>
        </div>

        <!-- Sekcja powiadomień -->
        <div class="bg-white p-4 rounded-lg shadow-md">
            <h2 class="text-lg font-semibold text-gray-700">Powiadomienia</h2>
            <div class="mt-4">
                <ul>
                    <li class="text-gray-600">Masz 3 nowe powiadomienia</li>
                    <li class="text-gray-600">Twoje konto zostało pomyślnie zaktualizowane</li>
                    <li class="text-gray-600">Nowe wydarzenie zostało dodane do kalendarza</li>
                </ul>
            </div>
        </div>

        <!-- Sekcja statystyk -->
        <div class="bg-white p-4 rounded-lg shadow-md">
            <h2 class="text-lg font-semibold text-gray-700">Statystyki</h2>
            <div class="mt-4">
                <p class="text-gray-600">Liczba zarejestrowanych wydarzeń: 5</p>
                <p class="text-gray-600">Liczba zarejestrowanych uczestników: 20</p>
                <p class="text-gray-600">Twoja aktywność w tym miesiącu: 12 godzin</p>
            </div>
        </div>
    </div>
</div>
