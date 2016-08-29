using System;

namespace GeoRent.Domain.Entities
{
    public class ResidenceImage
    {
        public ResidenceImage()
        {
            idResidenceImage = Guid.NewGuid();
        }

        public Guid idResidenceImage { get; set; }
        public string path { get; set; }
        public int resource { get; set; }
        public int order { get; set; }
        public virtual Residence idResidence { get; set; }
    }
}