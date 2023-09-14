<div class="m-10">
  <div class="text-center font-extrabold text-2xl">Lucky Draw Contestants</div>
  Number of contestants: {{ count($contestants) }}
  <div class="mt-5">
    <table class="w-full">
      <thead>
        <tr class="bg-gray-800 text-white">
          <td class="text-center p-4">ID</td>
          <td class="p-4">Name</td>
          <td class="p-4">Address</td>
          <td class="p-4">Contact</td>
        </tr>
      </thead>
      <tbody>
        @foreach ($contestants as $contestant)
          <tr>
            <td class="text-center p-4">{{ $contestant->id }}</td>
            <td class="p-4">{{ $contestant->name }}</td>
            <td class="p-4">{{ $contestant->address }}</td>
            <td class="p-4">{{ $contestant->contact }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
