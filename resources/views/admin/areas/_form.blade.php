<div class="mb-3">
    <label class="premium-label">Area Name</label>
    <input type="text" name="area" class="form-control premium-input @error('area') is-invalid @enderror" value="{{ old('area', $area->area ?? '') }}" required>
    @error('area') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>
<div class="mb-3">
    <label class="premium-label">District</label>
    <input type="text" name="district" class="form-control premium-input @error('district') is-invalid @enderror" value="{{ old('district', $area->district ?? '') }}" required>
    @error('district') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>
<div class="mb-3">
    <label class="premium-label">State</label>
    <input type="text" name="state" class="form-control premium-input @error('state') is-invalid @enderror" value="{{ old('state', $area->state ?? '') }}" required>
    @error('state') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>
<div class="mb-3">
    <label class="premium-label">Country</label>
    <input type="text" name="country" class="form-control premium-input @error('country') is-invalid @enderror" value="{{ old('country', $area->country ?? '') }}" required>
    @error('country') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>
<div class="mb-4">
    <label class="premium-label">Area Type</label>
    <input type="text" name="area_type" class="form-control premium-input @error('area_type') is-invalid @enderror" value="{{ old('area_type', $area->area_type ?? '') }}" required>
    @error('area_type') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>