<?php
$planList = \dash\data::planList();
?>

<!-- This example requires Tailwind CSS v2.0+ -->
<div class="bg-white">
    <div class="mx-auto max-w-7xl bg-white py-16 sm:py-24 sm:px-6 lg:px-8">
        <!-- xs to lg -->
        <div class="mx-auto max-w-2xl space-y-16 lg:hidden">
            <section>
                <div class="mb-8 px-4">
                    <h2 class="text-lg font-medium leading-6 text-gray-900">Basic</h2>
                    <p class="mt-4">
                        <span class="text-4xl font-bold tracking-tight text-gray-900">$9</span>
                        <span class="text-base font-medium text-gray-500">/mo</span>
                    </p>
                    <p class="mt-4 text-sm text-gray-500">Quis suspendisse ut fermentum neque vivamus non tellus.</p>
                    <a href="#"
                       class="mt-6 block w-full rounded-md border border-gray-800 bg-gray-800 py-2 text-center text-sm font-semibold text-white hover:bg-gray-900">Buy
                        Basic</a>
                </div>

                <table class="w-full">
                    <caption
                            class="border-t border-gray-200 bg-gray-50 py-3 px-4 text-left text-sm font-medium text-gray-900">
                        Features
                    </caption>
                    <thead>
                    <tr>
                        <th class="sr-only" scope="col">Feature</th>
                        <th class="sr-only" scope="col">Included</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                    <tr class="border-t border-gray-200">
                        <th class="py-5 px-4 text-left text-sm font-normal text-gray-500" scope="row">Molestie lobortis
                            massa.
                        </th>
                        <td class="py-5 pr-4">
                            <!-- Heroicon name: mini/check -->
                            <svg class="ml-auto h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                      d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                      clip-rule="evenodd"/>
                            </svg>
                            <span class="sr-only">Yes</span>
                        </td>
                    </tr>

                    <tr class="border-t border-gray-200">
                        <th class="py-5 px-4 text-left text-sm font-normal text-gray-500" scope="row">Urna purus
                            felis.
                        </th>
                        <td class="py-5 pr-4">
                            <!-- Heroicon name: mini/check -->
                            <svg class="ml-auto h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                      d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                      clip-rule="evenodd"/>
                            </svg>
                            <span class="sr-only">Yes</span>
                        </td>
                    </tr>

                    <tr class="border-t border-gray-200">
                        <th class="py-5 px-4 text-left text-sm font-normal text-gray-500" scope="row">Tellus pulvinar
                            sit dictum.
                        </th>
                        <td class="py-5 pr-4">
                            <!-- Heroicon name: mini/minus -->
                            <svg class="ml-auto h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                      d="M3 10a.75.75 0 01.75-.75h10.5a.75.75 0 010 1.5H3.75A.75.75 0 013 10z"
                                      clip-rule="evenodd"/>
                            </svg>
                            <span class="sr-only">No</span>
                        </td>
                    </tr>

                    <tr class="border-t border-gray-200">
                        <th class="py-5 px-4 text-left text-sm font-normal text-gray-500" scope="row">Convallis.</th>
                        <td class="py-5 pr-4">
                            <!-- Heroicon name: mini/minus -->
                            <svg class="ml-auto h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                      d="M3 10a.75.75 0 01.75-.75h10.5a.75.75 0 010 1.5H3.75A.75.75 0 013 10z"
                                      clip-rule="evenodd"/>
                            </svg>
                            <span class="sr-only">No</span>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <table class="w-full">
                    <caption
                            class="border-t border-gray-200 bg-gray-50 py-3 px-4 text-left text-sm font-medium text-gray-900">
                        Reporting
                    </caption>
                    <thead>
                    <tr>
                        <th class="sr-only" scope="col">Feature</th>
                        <th class="sr-only" scope="col">Included</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                    <tr class="border-t border-gray-200">
                        <th class="py-5 px-4 text-left text-sm font-normal text-gray-500" scope="row">Adipiscing.</th>
                        <td class="py-5 pr-4">
                            <!-- Heroicon name: mini/check -->
                            <svg class="ml-auto h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                      d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                      clip-rule="evenodd"/>
                            </svg>
                            <span class="sr-only">Yes</span>
                        </td>
                    </tr>

                    <tr class="border-t border-gray-200">
                        <th class="py-5 px-4 text-left text-sm font-normal text-gray-500" scope="row">Eget risus
                            integer.
                        </th>
                        <td class="py-5 pr-4">
                            <!-- Heroicon name: mini/minus -->
                            <svg class="ml-auto h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                      d="M3 10a.75.75 0 01.75-.75h10.5a.75.75 0 010 1.5H3.75A.75.75 0 013 10z"
                                      clip-rule="evenodd"/>
                            </svg>
                            <span class="sr-only">No</span>
                        </td>
                    </tr>

                    <tr class="border-t border-gray-200">
                        <th class="py-5 px-4 text-left text-sm font-normal text-gray-500" scope="row">Gravida leo urna
                            velit.
                        </th>
                        <td class="py-5 pr-4">
                            <!-- Heroicon name: mini/minus -->
                            <svg class="ml-auto h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                      d="M3 10a.75.75 0 01.75-.75h10.5a.75.75 0 010 1.5H3.75A.75.75 0 013 10z"
                                      clip-rule="evenodd"/>
                            </svg>
                            <span class="sr-only">No</span>
                        </td>
                    </tr>

                    <tr class="border-t border-gray-200">
                        <th class="py-5 px-4 text-left text-sm font-normal text-gray-500" scope="row">Elementum ut
                            dapibus mi feugiat cras nisl.
                        </th>
                        <td class="py-5 pr-4">
                            <!-- Heroicon name: mini/minus -->
                            <svg class="ml-auto h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                      d="M3 10a.75.75 0 01.75-.75h10.5a.75.75 0 010 1.5H3.75A.75.75 0 013 10z"
                                      clip-rule="evenodd"/>
                            </svg>
                            <span class="sr-only">No</span>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <table class="w-full">
                    <caption
                            class="border-t border-gray-200 bg-gray-50 py-3 px-4 text-left text-sm font-medium text-gray-900">
                        Support
                    </caption>
                    <thead>
                    <tr>
                        <th class="sr-only" scope="col">Feature</th>
                        <th class="sr-only" scope="col">Included</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                    <tr class="border-t border-gray-200">
                        <th class="py-5 px-4 text-left text-sm font-normal text-gray-500" scope="row">Sit dignissim.
                        </th>
                        <td class="py-5 pr-4">
                            <!-- Heroicon name: mini/check -->
                            <svg class="ml-auto h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                      d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                      clip-rule="evenodd"/>
                            </svg>
                            <span class="sr-only">Yes</span>
                        </td>
                    </tr>

                    <tr class="border-t border-gray-200">
                        <th class="py-5 px-4 text-left text-sm font-normal text-gray-500" scope="row">Congue at nibh
                            et.
                        </th>
                        <td class="py-5 pr-4">
                            <!-- Heroicon name: mini/minus -->
                            <svg class="ml-auto h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                      d="M3 10a.75.75 0 01.75-.75h10.5a.75.75 0 010 1.5H3.75A.75.75 0 013 10z"
                                      clip-rule="evenodd"/>
                            </svg>
                            <span class="sr-only">No</span>
                        </td>
                    </tr>

                    <tr class="border-t border-gray-200">
                        <th class="py-5 px-4 text-left text-sm font-normal text-gray-500" scope="row">Volutpat feugiat
                            mattis.
                        </th>
                        <td class="py-5 pr-4">
                            <!-- Heroicon name: mini/minus -->
                            <svg class="ml-auto h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                      d="M3 10a.75.75 0 01.75-.75h10.5a.75.75 0 010 1.5H3.75A.75.75 0 013 10z"
                                      clip-rule="evenodd"/>
                            </svg>
                            <span class="sr-only">No</span>
                        </td>
                    </tr>

                    <tr class="border-t border-gray-200">
                        <th class="py-5 px-4 text-left text-sm font-normal text-gray-500" scope="row">Tristique
                            pellentesque ornare diam sapien.
                        </th>
                        <td class="py-5 pr-4">
                            <!-- Heroicon name: mini/minus -->
                            <svg class="ml-auto h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                      d="M3 10a.75.75 0 01.75-.75h10.5a.75.75 0 010 1.5H3.75A.75.75 0 013 10z"
                                      clip-rule="evenodd"/>
                            </svg>
                            <span class="sr-only">No</span>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <div class="border-t border-gray-200 px-4 pt-5">
                    <a href="#"
                       class="block w-full rounded-md border border-gray-800 bg-gray-800 py-2 text-center text-sm font-semibold text-white hover:bg-gray-900">Buy
                        Basic</a>
                </div>
            </section>

            <section>
                <div class="mb-8 px-4">
                    <h2 class="text-lg font-medium leading-6 text-gray-900">Essential</h2>
                    <p class="mt-4">
                        <span class="text-4xl font-bold tracking-tight text-gray-900">$29</span>
                        <span class="text-base font-medium text-gray-500">/mo</span>
                    </p>
                    <p class="mt-4 text-sm text-gray-500">Quis eleifend a tincidunt pellentesque. A tempor in sed.</p>
                    <a href="#"
                       class="mt-6 block w-full rounded-md border border-gray-800 bg-gray-800 py-2 text-center text-sm font-semibold text-white hover:bg-gray-900">Buy
                        Essential</a>
                </div>

                <table class="w-full">
                    <caption
                            class="border-t border-gray-200 bg-gray-50 py-3 px-4 text-left text-sm font-medium text-gray-900">
                        Features
                    </caption>
                    <thead>
                    <tr>
                        <th class="sr-only" scope="col">Feature</th>
                        <th class="sr-only" scope="col">Included</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                    <tr class="border-t border-gray-200">
                        <th class="py-5 px-4 text-left text-sm font-normal text-gray-500" scope="row">Molestie lobortis
                            massa.
                        </th>
                        <td class="py-5 pr-4">
                            <!-- Heroicon name: mini/check -->
                            <svg class="ml-auto h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                      d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                      clip-rule="evenodd"/>
                            </svg>
                            <span class="sr-only">Yes</span>
                        </td>
                    </tr>

                    <tr class="border-t border-gray-200">
                        <th class="py-5 px-4 text-left text-sm font-normal text-gray-500" scope="row">Urna purus
                            felis.
                        </th>
                        <td class="py-5 pr-4">
                            <!-- Heroicon name: mini/check -->
                            <svg class="ml-auto h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                      d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                      clip-rule="evenodd"/>
                            </svg>
                            <span class="sr-only">Yes</span>
                        </td>
                    </tr>

                    <tr class="border-t border-gray-200">
                        <th class="py-5 px-4 text-left text-sm font-normal text-gray-500" scope="row">Tellus pulvinar
                            sit dictum.
                        </th>
                        <td class="py-5 pr-4">
                            <!-- Heroicon name: mini/check -->
                            <svg class="ml-auto h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                      d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                      clip-rule="evenodd"/>
                            </svg>
                            <span class="sr-only">Yes</span>
                        </td>
                    </tr>

                    <tr class="border-t border-gray-200">
                        <th class="py-5 px-4 text-left text-sm font-normal text-gray-500" scope="row">Convallis.</th>
                        <td class="py-5 pr-4">
                            <span class="block text-right text-sm text-gray-700">Up to 20 users</span>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <table class="w-full">
                    <caption
                            class="border-t border-gray-200 bg-gray-50 py-3 px-4 text-left text-sm font-medium text-gray-900">
                        Reporting
                    </caption>
                    <thead>
                    <tr>
                        <th class="sr-only" scope="col">Feature</th>
                        <th class="sr-only" scope="col">Included</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                    <tr class="border-t border-gray-200">
                        <th class="py-5 px-4 text-left text-sm font-normal text-gray-500" scope="row">Adipiscing.</th>
                        <td class="py-5 pr-4">
                            <!-- Heroicon name: mini/check -->
                            <svg class="ml-auto h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                      d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                      clip-rule="evenodd"/>
                            </svg>
                            <span class="sr-only">Yes</span>
                        </td>
                    </tr>

                    <tr class="border-t border-gray-200">
                        <th class="py-5 px-4 text-left text-sm font-normal text-gray-500" scope="row">Eget risus
                            integer.
                        </th>
                        <td class="py-5 pr-4">
                            <!-- Heroicon name: mini/check -->
                            <svg class="ml-auto h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                      d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                      clip-rule="evenodd"/>
                            </svg>
                            <span class="sr-only">Yes</span>
                        </td>
                    </tr>

                    <tr class="border-t border-gray-200">
                        <th class="py-5 px-4 text-left text-sm font-normal text-gray-500" scope="row">Gravida leo urna
                            velit.
                        </th>
                        <td class="py-5 pr-4">
                            <!-- Heroicon name: mini/minus -->
                            <svg class="ml-auto h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                      d="M3 10a.75.75 0 01.75-.75h10.5a.75.75 0 010 1.5H3.75A.75.75 0 013 10z"
                                      clip-rule="evenodd"/>
                            </svg>
                            <span class="sr-only">No</span>
                        </td>
                    </tr>

                    <tr class="border-t border-gray-200">
                        <th class="py-5 px-4 text-left text-sm font-normal text-gray-500" scope="row">Elementum ut
                            dapibus mi feugiat cras nisl.
                        </th>
                        <td class="py-5 pr-4">
                            <!-- Heroicon name: mini/minus -->
                            <svg class="ml-auto h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                      d="M3 10a.75.75 0 01.75-.75h10.5a.75.75 0 010 1.5H3.75A.75.75 0 013 10z"
                                      clip-rule="evenodd"/>
                            </svg>
                            <span class="sr-only">No</span>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <table class="w-full">
                    <caption
                            class="border-t border-gray-200 bg-gray-50 py-3 px-4 text-left text-sm font-medium text-gray-900">
                        Support
                    </caption>
                    <thead>
                    <tr>
                        <th class="sr-only" scope="col">Feature</th>
                        <th class="sr-only" scope="col">Included</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                    <tr class="border-t border-gray-200">
                        <th class="py-5 px-4 text-left text-sm font-normal text-gray-500" scope="row">Sit dignissim.
                        </th>
                        <td class="py-5 pr-4">
                            <!-- Heroicon name: mini/check -->
                            <svg class="ml-auto h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                      d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                      clip-rule="evenodd"/>
                            </svg>
                            <span class="sr-only">Yes</span>
                        </td>
                    </tr>

                    <tr class="border-t border-gray-200">
                        <th class="py-5 px-4 text-left text-sm font-normal text-gray-500" scope="row">Congue at nibh
                            et.
                        </th>
                        <td class="py-5 pr-4">
                            <!-- Heroicon name: mini/check -->
                            <svg class="ml-auto h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                      d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                      clip-rule="evenodd"/>
                            </svg>
                            <span class="sr-only">Yes</span>
                        </td>
                    </tr>

                    <tr class="border-t border-gray-200">
                        <th class="py-5 px-4 text-left text-sm font-normal text-gray-500" scope="row">Volutpat feugiat
                            mattis.
                        </th>
                        <td class="py-5 pr-4">
                            <!-- Heroicon name: mini/check -->
                            <svg class="ml-auto h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                      d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                      clip-rule="evenodd"/>
                            </svg>
                            <span class="sr-only">Yes</span>
                        </td>
                    </tr>

                    <tr class="border-t border-gray-200">
                        <th class="py-5 px-4 text-left text-sm font-normal text-gray-500" scope="row">Tristique
                            pellentesque ornare diam sapien.
                        </th>
                        <td class="py-5 pr-4">
                            <!-- Heroicon name: mini/minus -->
                            <svg class="ml-auto h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                      d="M3 10a.75.75 0 01.75-.75h10.5a.75.75 0 010 1.5H3.75A.75.75 0 013 10z"
                                      clip-rule="evenodd"/>
                            </svg>
                            <span class="sr-only">No</span>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <div class="border-t border-gray-200 px-4 pt-5">
                    <a href="#"
                       class="block w-full rounded-md border border-gray-800 bg-gray-800 py-2 text-center text-sm font-semibold text-white hover:bg-gray-900">Buy
                        Essential</a>
                </div>
            </section>

            <section>
                <div class="mb-8 px-4">
                    <h2 class="text-lg font-medium leading-6 text-gray-900">Premium</h2>
                    <p class="mt-4">
                        <span class="text-4xl font-bold tracking-tight text-gray-900">$59</span>
                        <span class="text-base font-medium text-gray-500">/mo</span>
                    </p>
                    <p class="mt-4 text-sm text-gray-500">Orci volutpat ut sed sed neque, dui eget. Quis tristique
                        non.</p>
                    <a href="#"
                       class="mt-6 block w-full rounded-md border border-gray-800 bg-gray-800 py-2 text-center text-sm font-semibold text-white hover:bg-gray-900">Buy
                        Premium</a>
                </div>

                <table class="w-full">
                    <caption
                            class="border-t border-gray-200 bg-gray-50 py-3 px-4 text-left text-sm font-medium text-gray-900">
                        Features
                    </caption>
                    <thead>
                    <tr>
                        <th class="sr-only" scope="col">Feature</th>
                        <th class="sr-only" scope="col">Included</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                    <tr class="border-t border-gray-200">
                        <th class="py-5 px-4 text-left text-sm font-normal text-gray-500" scope="row">Molestie lobortis
                            massa.
                        </th>
                        <td class="py-5 pr-4">
                            <!-- Heroicon name: mini/check -->
                            <svg class="ml-auto h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                      d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                      clip-rule="evenodd"/>
                            </svg>
                            <span class="sr-only">Yes</span>
                        </td>
                    </tr>

                    <tr class="border-t border-gray-200">
                        <th class="py-5 px-4 text-left text-sm font-normal text-gray-500" scope="row">Urna purus
                            felis.
                        </th>
                        <td class="py-5 pr-4">
                            <!-- Heroicon name: mini/check -->
                            <svg class="ml-auto h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                      d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                      clip-rule="evenodd"/>
                            </svg>
                            <span class="sr-only">Yes</span>
                        </td>
                    </tr>

                    <tr class="border-t border-gray-200">
                        <th class="py-5 px-4 text-left text-sm font-normal text-gray-500" scope="row">Tellus pulvinar
                            sit dictum.
                        </th>
                        <td class="py-5 pr-4">
                            <!-- Heroicon name: mini/check -->
                            <svg class="ml-auto h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                      d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                      clip-rule="evenodd"/>
                            </svg>
                            <span class="sr-only">Yes</span>
                        </td>
                    </tr>

                    <tr class="border-t border-gray-200">
                        <th class="py-5 px-4 text-left text-sm font-normal text-gray-500" scope="row">Convallis.</th>
                        <td class="py-5 pr-4">
                            <span class="block text-right text-sm text-gray-700">Up to 50 users</span>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <table class="w-full">
                    <caption
                            class="border-t border-gray-200 bg-gray-50 py-3 px-4 text-left text-sm font-medium text-gray-900">
                        Reporting
                    </caption>
                    <thead>
                    <tr>
                        <th class="sr-only" scope="col">Feature</th>
                        <th class="sr-only" scope="col">Included</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                    <tr class="border-t border-gray-200">
                        <th class="py-5 px-4 text-left text-sm font-normal text-gray-500" scope="row">Adipiscing.</th>
                        <td class="py-5 pr-4">
                            <!-- Heroicon name: mini/check -->
                            <svg class="ml-auto h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                      d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                      clip-rule="evenodd"/>
                            </svg>
                            <span class="sr-only">Yes</span>
                        </td>
                    </tr>

                    <tr class="border-t border-gray-200">
                        <th class="py-5 px-4 text-left text-sm font-normal text-gray-500" scope="row">Eget risus
                            integer.
                        </th>
                        <td class="py-5 pr-4">
                            <!-- Heroicon name: mini/check -->
                            <svg class="ml-auto h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                      d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                      clip-rule="evenodd"/>
                            </svg>
                            <span class="sr-only">Yes</span>
                        </td>
                    </tr>

                    <tr class="border-t border-gray-200">
                        <th class="py-5 px-4 text-left text-sm font-normal text-gray-500" scope="row">Gravida leo urna
                            velit.
                        </th>
                        <td class="py-5 pr-4">
                            <!-- Heroicon name: mini/check -->
                            <svg class="ml-auto h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                      d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                      clip-rule="evenodd"/>
                            </svg>
                            <span class="sr-only">Yes</span>
                        </td>
                    </tr>

                    <tr class="border-t border-gray-200">
                        <th class="py-5 px-4 text-left text-sm font-normal text-gray-500" scope="row">Elementum ut
                            dapibus mi feugiat cras nisl.
                        </th>
                        <td class="py-5 pr-4">
                            <!-- Heroicon name: mini/check -->
                            <svg class="ml-auto h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                      d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                      clip-rule="evenodd"/>
                            </svg>
                            <span class="sr-only">Yes</span>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <table class="w-full">
                    <caption
                            class="border-t border-gray-200 bg-gray-50 py-3 px-4 text-left text-sm font-medium text-gray-900">
                        Support
                    </caption>
                    <thead>
                    <tr>
                        <th class="sr-only" scope="col">Feature</th>
                        <th class="sr-only" scope="col">Included</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                    <tr class="border-t border-gray-200">
                        <th class="py-5 px-4 text-left text-sm font-normal text-gray-500" scope="row">Sit dignissim.
                        </th>
                        <td class="py-5 pr-4">
                            <!-- Heroicon name: mini/check -->
                            <svg class="ml-auto h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                      d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                      clip-rule="evenodd"/>
                            </svg>
                            <span class="sr-only">Yes</span>
                        </td>
                    </tr>

                    <tr class="border-t border-gray-200">
                        <th class="py-5 px-4 text-left text-sm font-normal text-gray-500" scope="row">Congue at nibh
                            et.
                        </th>
                        <td class="py-5 pr-4">
                            <!-- Heroicon name: mini/check -->
                            <svg class="ml-auto h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                      d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                      clip-rule="evenodd"/>
                            </svg>
                            <span class="sr-only">Yes</span>
                        </td>
                    </tr>

                    <tr class="border-t border-gray-200">
                        <th class="py-5 px-4 text-left text-sm font-normal text-gray-500" scope="row">Volutpat feugiat
                            mattis.
                        </th>
                        <td class="py-5 pr-4">
                            <!-- Heroicon name: mini/check -->
                            <svg class="ml-auto h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                      d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                      clip-rule="evenodd"/>
                            </svg>
                            <span class="sr-only">Yes</span>
                        </td>
                    </tr>

                    <tr class="border-t border-gray-200">
                        <th class="py-5 px-4 text-left text-sm font-normal text-gray-500" scope="row">Tristique
                            pellentesque ornare diam sapien.
                        </th>
                        <td class="py-5 pr-4">
                            <!-- Heroicon name: mini/check -->
                            <svg class="ml-auto h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                      d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                      clip-rule="evenodd"/>
                            </svg>
                            <span class="sr-only">Yes</span>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <div class="border-t border-gray-200 px-4 pt-5">
                    <a href="#"
                       class="block w-full rounded-md border border-gray-800 bg-gray-800 py-2 text-center text-sm font-semibold text-white hover:bg-gray-900">Buy
                        Premium</a>
                </div>
            </section>
        </div>

        <!-- lg+ -->
        <div class="hidden lg:block">
            <table class="h-px w-full table-fixed">
                <caption class="sr-only">
                    Pricing plan comparison
                </caption>
                <thead>
                <tr>
                    <th class="px-6 pb-4 text-left text-sm font-medium text-gray-900" scope="col">
                        <span class="sr-only">Feature by</span>
                        <span>Plans</span>
                    </th>

                    <th class="w-1/4 px-6 pb-4 text-left text-lg font-medium leading-6 text-gray-900" scope="col">
                        Basic
                    </th>

                    <th class="w-1/4 px-6 pb-4 text-left text-lg font-medium leading-6 text-gray-900" scope="col">
                        Essential
                    </th>

                    <th class="w-1/4 px-6 pb-4 text-left text-lg font-medium leading-6 text-gray-900" scope="col">
                        Premium
                    </th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 border-t border-gray-200">
                <tr>
                    <th class="py-8 px-6 text-left align-top text-sm font-medium text-gray-900" scope="row">Pricing</th>

                    <td class="h-full py-8 px-6 align-top">
                        <div class="relative table h-full">
                            <p>
                                <span class="text-4xl font-bold tracking-tight text-gray-900">$9</span>
                                <span class="text-base font-medium text-gray-500">/mo</span>
                            </p>
                            <p class="mt-4 mb-16 text-sm text-gray-500">Quis suspendisse ut fermentum neque vivamus non
                                tellus.</p>
                            <a href="#"
                               class="5 absolute bottom-0 block w-full flex-grow rounded-md border border-gray-800 bg-gray-800 py-2 text-center text-sm font-semibold text-white hover:bg-gray-900">Buy
                                Basic</a>
                        </div>
                    </td>

                    <td class="h-full py-8 px-6 align-top">
                        <div class="relative table h-full">
                            <p>
                                <span class="text-4xl font-bold tracking-tight text-gray-900">$29</span>
                                <span class="text-base font-medium text-gray-500">/mo</span>
                            </p>
                            <p class="mt-4 mb-16 text-sm text-gray-500">Quis eleifend a tincidunt pellentesque. A tempor
                                in sed.</p>
                            <a href="#"
                               class="5 absolute bottom-0 block w-full flex-grow rounded-md border border-gray-800 bg-gray-800 py-2 text-center text-sm font-semibold text-white hover:bg-gray-900">Buy
                                Essential</a>
                        </div>
                    </td>

                    <td class="h-full py-8 px-6 align-top">
                        <div class="relative table h-full">
                            <p>
                                <span class="text-4xl font-bold tracking-tight text-gray-900">$59</span>
                                <span class="text-base font-medium text-gray-500">/mo</span>
                            </p>
                            <p class="mt-4 mb-16 text-sm text-gray-500">Orci volutpat ut sed sed neque, dui eget. Quis
                                tristique non.</p>
                            <a href="#"
                               class="5 absolute bottom-0 block w-full flex-grow rounded-md border border-gray-800 bg-gray-800 py-2 text-center text-sm font-semibold text-white hover:bg-gray-900">Buy
                                Premium</a>
                        </div>
                    </td>
                </tr>

                <tr>
                    <th class="bg-gray-50 py-3 pl-6 text-left text-sm font-medium text-gray-900" colspan="4"
                        scope="colgroup">Features
                    </th>
                </tr>

                <tr>
                    <th class="py-5 px-6 text-left text-sm font-normal text-gray-500" scope="row">Molestie lobortis
                        massa.
                    </th>

                    <td class="py-5 px-6">
                        <!-- Heroicon name: mini/check -->
                        <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                             fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                  d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                  clip-rule="evenodd"/>
                        </svg>
                        <span class="sr-only">Included in Basic</span>
                    </td>

                    <td class="py-5 px-6">
                        <!-- Heroicon name: mini/check -->
                        <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                             fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                  d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                  clip-rule="evenodd"/>
                        </svg>
                        <span class="sr-only">Included in Essential</span>
                    </td>

                    <td class="py-5 px-6">
                        <!-- Heroicon name: mini/check -->
                        <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                             fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                  d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                  clip-rule="evenodd"/>
                        </svg>
                        <span class="sr-only">Included in Premium</span>
                    </td>
                </tr>

                <tr>
                    <th class="py-5 px-6 text-left text-sm font-normal text-gray-500" scope="row">Urna purus felis.</th>

                    <td class="py-5 px-6">
                        <!-- Heroicon name: mini/check -->
                        <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                             fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                  d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                  clip-rule="evenodd"/>
                        </svg>
                        <span class="sr-only">Included in Basic</span>
                    </td>

                    <td class="py-5 px-6">
                        <!-- Heroicon name: mini/check -->
                        <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                             fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                  d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                  clip-rule="evenodd"/>
                        </svg>
                        <span class="sr-only">Included in Essential</span>
                    </td>

                    <td class="py-5 px-6">
                        <!-- Heroicon name: mini/check -->
                        <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                             fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                  d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                  clip-rule="evenodd"/>
                        </svg>
                        <span class="sr-only">Included in Premium</span>
                    </td>
                </tr>

                <tr>
                    <th class="py-5 px-6 text-left text-sm font-normal text-gray-500" scope="row">Tellus pulvinar sit
                        dictum.
                    </th>

                    <td class="py-5 px-6">
                        <!-- Heroicon name: mini/minus -->
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                             fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                  d="M3 10a.75.75 0 01.75-.75h10.5a.75.75 0 010 1.5H3.75A.75.75 0 013 10z"
                                  clip-rule="evenodd"/>
                        </svg>
                        <span class="sr-only">Not included in Basic</span>
                    </td>

                    <td class="py-5 px-6">
                        <!-- Heroicon name: mini/check -->
                        <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                             fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                  d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                  clip-rule="evenodd"/>
                        </svg>
                        <span class="sr-only">Included in Essential</span>
                    </td>

                    <td class="py-5 px-6">
                        <!-- Heroicon name: mini/check -->
                        <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                             fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                  d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                  clip-rule="evenodd"/>
                        </svg>
                        <span class="sr-only">Included in Premium</span>
                    </td>
                </tr>

                <tr>
                    <th class="py-5 px-6 text-left text-sm font-normal text-gray-500" scope="row">Convallis.</th>

                    <td class="py-5 px-6">
                        <!-- Heroicon name: mini/minus -->
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                             fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                  d="M3 10a.75.75 0 01.75-.75h10.5a.75.75 0 010 1.5H3.75A.75.75 0 013 10z"
                                  clip-rule="evenodd"/>
                        </svg>
                        <span class="sr-only">Not included in Basic</span>
                    </td>

                    <td class="py-5 px-6">
                        <span class="block text-sm text-gray-700">Up to 20 users</span>
                    </td>

                    <td class="py-5 px-6">
                        <span class="block text-sm text-gray-700">Up to 50 users</span>
                    </td>
                </tr>

                <tr>
                    <th class="bg-gray-50 py-3 pl-6 text-left text-sm font-medium text-gray-900" colspan="4"
                        scope="colgroup">Reporting
                    </th>
                </tr>

                <tr>
                    <th class="py-5 px-6 text-left text-sm font-normal text-gray-500" scope="row">Adipiscing.</th>

                    <td class="py-5 px-6">
                        <!-- Heroicon name: mini/check -->
                        <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                             fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                  d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                  clip-rule="evenodd"/>
                        </svg>
                        <span class="sr-only">Included in Basic</span>
                    </td>

                    <td class="py-5 px-6">
                        <!-- Heroicon name: mini/check -->
                        <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                             fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                  d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                  clip-rule="evenodd"/>
                        </svg>
                        <span class="sr-only">Included in Essential</span>
                    </td>

                    <td class="py-5 px-6">
                        <!-- Heroicon name: mini/check -->
                        <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                             fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                  d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                  clip-rule="evenodd"/>
                        </svg>
                        <span class="sr-only">Included in Premium</span>
                    </td>
                </tr>

                <tr>
                    <th class="py-5 px-6 text-left text-sm font-normal text-gray-500" scope="row">Eget risus integer.
                    </th>

                    <td class="py-5 px-6">
                        <!-- Heroicon name: mini/minus -->
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                             fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                  d="M3 10a.75.75 0 01.75-.75h10.5a.75.75 0 010 1.5H3.75A.75.75 0 013 10z"
                                  clip-rule="evenodd"/>
                        </svg>
                        <span class="sr-only">Not included in Basic</span>
                    </td>

                    <td class="py-5 px-6">
                        <!-- Heroicon name: mini/check -->
                        <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                             fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                  d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                  clip-rule="evenodd"/>
                        </svg>
                        <span class="sr-only">Included in Essential</span>
                    </td>

                    <td class="py-5 px-6">
                        <!-- Heroicon name: mini/check -->
                        <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                             fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                  d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                  clip-rule="evenodd"/>
                        </svg>
                        <span class="sr-only">Included in Premium</span>
                    </td>
                </tr>

                <tr>
                    <th class="py-5 px-6 text-left text-sm font-normal text-gray-500" scope="row">Gravida leo urna
                        velit.
                    </th>

                    <td class="py-5 px-6">
                        <!-- Heroicon name: mini/minus -->
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                             fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                  d="M3 10a.75.75 0 01.75-.75h10.5a.75.75 0 010 1.5H3.75A.75.75 0 013 10z"
                                  clip-rule="evenodd"/>
                        </svg>
                        <span class="sr-only">Not included in Basic</span>
                    </td>

                    <td class="py-5 px-6">
                        <!-- Heroicon name: mini/minus -->
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                             fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                  d="M3 10a.75.75 0 01.75-.75h10.5a.75.75 0 010 1.5H3.75A.75.75 0 013 10z"
                                  clip-rule="evenodd"/>
                        </svg>
                        <span class="sr-only">Not included in Essential</span>
                    </td>

                    <td class="py-5 px-6">
                        <!-- Heroicon name: mini/check -->
                        <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                             fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                  d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                  clip-rule="evenodd"/>
                        </svg>
                        <span class="sr-only">Included in Premium</span>
                    </td>
                </tr>

                <tr>
                    <th class="py-5 px-6 text-left text-sm font-normal text-gray-500" scope="row">Elementum ut dapibus
                        mi feugiat cras nisl.
                    </th>

                    <td class="py-5 px-6">
                        <!-- Heroicon name: mini/minus -->
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                             fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                  d="M3 10a.75.75 0 01.75-.75h10.5a.75.75 0 010 1.5H3.75A.75.75 0 013 10z"
                                  clip-rule="evenodd"/>
                        </svg>
                        <span class="sr-only">Not included in Basic</span>
                    </td>

                    <td class="py-5 px-6">
                        <!-- Heroicon name: mini/minus -->
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                             fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                  d="M3 10a.75.75 0 01.75-.75h10.5a.75.75 0 010 1.5H3.75A.75.75 0 013 10z"
                                  clip-rule="evenodd"/>
                        </svg>
                        <span class="sr-only">Not included in Essential</span>
                    </td>

                    <td class="py-5 px-6">
                        <!-- Heroicon name: mini/check -->
                        <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                             fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                  d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                  clip-rule="evenodd"/>
                        </svg>
                        <span class="sr-only">Included in Premium</span>
                    </td>
                </tr>

                <tr>
                    <th class="bg-gray-50 py-3 pl-6 text-left text-sm font-medium text-gray-900" colspan="4"
                        scope="colgroup">Support
                    </th>
                </tr>

                <tr>
                    <th class="py-5 px-6 text-left text-sm font-normal text-gray-500" scope="row">Sit dignissim.</th>

                    <td class="py-5 px-6">
                        <!-- Heroicon name: mini/check -->
                        <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                             fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                  d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                  clip-rule="evenodd"/>
                        </svg>
                        <span class="sr-only">Included in Basic</span>
                    </td>

                    <td class="py-5 px-6">
                        <!-- Heroicon name: mini/check -->
                        <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                             fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                  d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                  clip-rule="evenodd"/>
                        </svg>
                        <span class="sr-only">Included in Essential</span>
                    </td>

                    <td class="py-5 px-6">
                        <!-- Heroicon name: mini/check -->
                        <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                             fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                  d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                  clip-rule="evenodd"/>
                        </svg>
                        <span class="sr-only">Included in Premium</span>
                    </td>
                </tr>

                <tr>
                    <th class="py-5 px-6 text-left text-sm font-normal text-gray-500" scope="row">Congue at nibh et.
                    </th>

                    <td class="py-5 px-6">
                        <!-- Heroicon name: mini/minus -->
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                             fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                  d="M3 10a.75.75 0 01.75-.75h10.5a.75.75 0 010 1.5H3.75A.75.75 0 013 10z"
                                  clip-rule="evenodd"/>
                        </svg>
                        <span class="sr-only">Not included in Basic</span>
                    </td>

                    <td class="py-5 px-6">
                        <!-- Heroicon name: mini/check -->
                        <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                             fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                  d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                  clip-rule="evenodd"/>
                        </svg>
                        <span class="sr-only">Included in Essential</span>
                    </td>

                    <td class="py-5 px-6">
                        <!-- Heroicon name: mini/check -->
                        <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                             fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                  d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                  clip-rule="evenodd"/>
                        </svg>
                        <span class="sr-only">Included in Premium</span>
                    </td>
                </tr>

                <tr>
                    <th class="py-5 px-6 text-left text-sm font-normal text-gray-500" scope="row">Volutpat feugiat
                        mattis.
                    </th>

                    <td class="py-5 px-6">
                        <!-- Heroicon name: mini/minus -->
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                             fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                  d="M3 10a.75.75 0 01.75-.75h10.5a.75.75 0 010 1.5H3.75A.75.75 0 013 10z"
                                  clip-rule="evenodd"/>
                        </svg>
                        <span class="sr-only">Not included in Basic</span>
                    </td>

                    <td class="py-5 px-6">
                        <!-- Heroicon name: mini/check -->
                        <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                             fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                  d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                  clip-rule="evenodd"/>
                        </svg>
                        <span class="sr-only">Included in Essential</span>
                    </td>

                    <td class="py-5 px-6">
                        <!-- Heroicon name: mini/check -->
                        <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                             fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                  d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                  clip-rule="evenodd"/>
                        </svg>
                        <span class="sr-only">Included in Premium</span>
                    </td>
                </tr>

                <tr>
                    <th class="py-5 px-6 text-left text-sm font-normal text-gray-500" scope="row">Tristique pellentesque
                        ornare diam sapien.
                    </th>

                    <td class="py-5 px-6">
                        <!-- Heroicon name: mini/minus -->
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                             fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                  d="M3 10a.75.75 0 01.75-.75h10.5a.75.75 0 010 1.5H3.75A.75.75 0 013 10z"
                                  clip-rule="evenodd"/>
                        </svg>
                        <span class="sr-only">Not included in Basic</span>
                    </td>

                    <td class="py-5 px-6">
                        <!-- Heroicon name: mini/minus -->
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                             fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                  d="M3 10a.75.75 0 01.75-.75h10.5a.75.75 0 010 1.5H3.75A.75.75 0 013 10z"
                                  clip-rule="evenodd"/>
                        </svg>
                        <span class="sr-only">Not included in Essential</span>
                    </td>

                    <td class="py-5 px-6">
                        <!-- Heroicon name: mini/check -->
                        <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                             fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                  d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                  clip-rule="evenodd"/>
                        </svg>
                        <span class="sr-only">Included in Premium</span>
                    </td>
                </tr>
                </tbody>
                <tfoot>
                <tr class="border-t border-gray-200">
                    <th class="sr-only" scope="row">Choose your plan</th>

                    <td class="px-6 pt-5">
                        <a href="#"
                           class="block w-full rounded-md border border-gray-800 bg-gray-800 py-2 text-center text-sm font-semibold text-white hover:bg-gray-900">Buy
                            Basic</a>
                    </td>

                    <td class="px-6 pt-5">
                        <a href="#"
                           class="block w-full rounded-md border border-gray-800 bg-gray-800 py-2 text-center text-sm font-semibold text-white hover:bg-gray-900">Buy
                            Essential</a>
                    </td>

                    <td class="px-6 pt-5">
                        <a href="#"
                           class="block w-full rounded-md border border-gray-800 bg-gray-800 py-2 text-center text-sm font-semibold text-white hover:bg-gray-900">Buy
                            Premium</a>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
