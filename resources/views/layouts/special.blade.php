{{-- this layout file is for pages with special headers --}}

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <livewire:styles />
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


  <!-- main css -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

  <!-- Favicons -->
  <link href="{{ asset('assets/images/favicon.png') }}" rel="icon">
  <link href="{{ asset('assets/images/favicon.png') }}" rel="apple-touch-icon">
  <!-- material icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">



  <meta name="author" content="Kunal Pandharkar">
  <meta name="twitter:title" content="Skyline Distributors | Aurangabad">
  <meta name="twitter:description"
    content="designed and promoted by maharashtra industries directory, www.maharashtradirectory.com" />

    <meta name="keywords"
    content="Ingersoll Rand Compressors, Air Compressors, High Pressure Air Compressors, Rotary Compressors, Screw Compressors, Air Dryers, Vacuum Pumps, Air Receivers, Reciprocating T30 Air Compressors, Non Lubricated Air Compressors, Refrigerated Type Air Dryers, Line Air Filters, Large Reciprocating NL Air Compressors, Ingersoll TFM DIV, Pneumatic Tools, Battery Operated Tools, Torque Wrenches, Oil Pulse Tools, Auto Shut Off Type Pneumatic Tools, Fluid Handling Solutions, Air Operated Pumps, Diaphragm Pumps, Grease Pumps, Material Handling Solutions, Rail Systems, Air Balancers, Fastener Tightening Systems, DC Electric Nut Runners, Angle Nut Runners, Assembly Solutions, Inline Nut Runners, Remote Start Air Nut Runners, Quick Multipliers, Torque Arms, Angle Type Tools, Pistol Type Tools, Cordless Oil Pulse Tools, Open Ended Wrenches, Ratchet Wrenches, QI Impact Screw Drivers, Auto Shut Off Screw Drivers, Impact Wrenches, Impact Screwdrivers, Cordless Tools, Torque Testers, Bonfigilioli, Gearboxes, Geared Motors, Inline Helical Geared Motors, 300 Series Planetary Gearboxes, BN Motor Standard As Well As Break Motor, A Series Helical Bevel Geared Motors, VF Worm Gearboxes, W Worm Gearboxes, Break Motors, Selec Process Controls, Electrical Panel Meters, Multifunction Meters, Temperature Controllers, Process Indicators, Digital Timers, Analog Timers, Counters, Hot Runner Controllers, PLC, VAF Meters, Energy Meters, Digital Panel Meters, Cooling Controllers, Profile Controllers, Time Measuring Instruments, PID Controllers, Temperature Controllers, Mercury Pneumatics Pvt. Ltd., Hydro Pneumatic Presses, Pneumatic Cylinders, Air To Air Boosters, FRL Units, Push Type Fittings, Pu Tubes, Polyurethane Tubes, Solenoid Valves, Grease Pumps, Hydro Pneumatic Pumps, Swivel Flow Control Valves, Pilot Operated Valves, Hand Lever Valves, Quick Exhaust Valves, Gate Valves, Shuttle Valves, Hand Slide, Non Return Valves, Throttle & Check Valves, Renold Chain, Roller Chains, Stainless Steel Chains, Attachment Chains, Chain Sprockets, Conveyor Chains, Mather Platt Wilo, End Suction Pumps, Splite Case Pumps, Submersible Sewage, Vertical Multistage Pumps, Fire Fighting Pumps, Willo Jet Pumps, Single Booster Pumps, Pressure Boosting Systems, Single Stage Low Pressure Centrifugal Pumps, Submersible Pump In Tie Rod Version, Basement Drainage Pumps, Water Cooled, Self Priming Drainage Pumps, Stainless Steel Chains, Attachment Chains, Chain Sprockets, Conveyor Chains, Sudha Ventilating Systems, Windy Turbo Ventilators For General Duty Applications, Hurricane Wind Ventilators, Vertical Vane Wind Ventilators, Eco Power, Safe Lux For Safe Roof Daylighting, Dilip Material Handling, Hydraulic Hand Pallet Trucks, High Lifting Hand Pallet Trucks, Hand Operated Stackers, Semi Electrical Stackers, Hydraulic Scissor Lift Tables, Hydraulic Doc Levelers, Battery Operated Stackers, Bilz Anti Vibration Mounts, Insulating Plates, Levelling Elements, Wedge Mounts, Vibration Measurement & Analysis, Anti Vibration Mounts, AVM, Rubber Air Springs, Vitap, Insulation Tables, Levelling Tables, Bi Air Springs, Air Springs, Bilz Table Application, Vibration Isolated Foundation, Air Membrane Air Springs, Hydro Techniqe, Lubrication Pumps And Fittings, Motorized Lubrication Units, Multi Port Lubrication, Rotary Pumps, Motor Pump Assembly, Hand Operated Oil Pumps, Hand Operated Grease Pumps, Oil Circulating Units, Metering Injectors, Radial Multi Outlet Lubricator Grease Oil, Manifold Tubes And Fitting, Automatic Motorized Lubrication Units, Orione, Hydraulic Jacks, Hydraulic Hand Pumps, Dutta Control, ISO Economy Pneumatic Cylinders, Hydraulic Cylinders, Swivel Flow Control Valves, Solenoid Valves, Pilot Operated Valves, Hand Lever Valves, Quick Exhaust Valves, Non Return Valves, Sai Control Systems, Inductive Proximity Switches, Capacitive Proximity Switches, Optical Proximity Switches, Vibratory Bowl Feeders, Magnetic Proximity Switches, Switching Mode Power Supplies, SMPS, Electromagnetic Vibrator Controllers, R K Rathod & Sons, All Types Of Trolley Wheels, Caster Wheels, Master Zippel, Industrial Cleaning Systems, Special Purpose Cleaning Machines, Ultrasonic Cleaning Machines, Master Automation And Robotics, Overhead Conveyor Systems, Sensography, Temperature Sensors, Thermocouple And RTD Connectors, Special Type Temperature Sensors, Temperature Transmitters, Industrial Thermowell, Thermocouple Connectors, RTD Connectors, Thermocouple & RTD Connectors, Portable Temperature Indicators, Level Switches, WIKA, Pressure Gauges, Temperature Gauges, Pressure Transmitters, Temperature Transmitters, Authorized Distributor, Dealer, Aurangabad, Maharashtra, India">
  <meta property="og:title" content="@yield('ogtitle')">
  <meta property="og:url" content="wwww.skyline.com">
  <meta property="og:image" content="https://samvaidya961.github.io/skyline/assets/images/favicon.png">
  <meta property="og:image:type" content="image/png">
  <meta property="og:image:width" content="1024">
  <meta property="og:image:height" content="1024">

  <title>@yield('title')</title>
</head>

<body>
    <x-header-special :title="$headertitle" />
    
    @yield('content')

    <x-footer />
  <a href="bulkquote.html" class="back-to-top d-flex align-items-center justify-content-center">
  <img src="{{ asset('assets/images/bulkquote.png') }}" alt="">
  <button class="btn bg-orange">Bulk Quote</button></a>
  <livewire:scripts />
  <!-- Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>


  <!-- site javascript -->
  <script src="{{ asset('assets/js/site.js') }}"></script>

</body>

</html>